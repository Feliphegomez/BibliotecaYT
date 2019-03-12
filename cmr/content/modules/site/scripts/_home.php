<script>
	// ------------ INICIO ------------------------------------- 
	var Home = Vue.extend({
		template: '#page-home',
		data: function () {
			return {
				posts: [],
				searchKey: ''
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.posts = [];
			
			apiIW.get('/videos_yt', {
				params: {
					join: [
						// 'pictures',
						'videos_yt_files',
					]
				}
			}).then(function (response) {
				self.posts = response.data.records;
			}).catch(function (error) {
				// $.notify(error.response.code + error.response.message, "error");
			});
		},
		computed: {
			filteredposts: function () {
				return this.posts.filter(function (post) {
					return this.searchKey.toLowerCase() == '' || post.title.toLowerCase().indexOf(this.searchKey.toLowerCase()) !== -1;
				},this);
			}
		}
	});
	
	
	var View_Video = Vue.extend({
		template: '#page-view-video',
		data: function () {
			return {
				post: {
				  "id": 0,
				  "ref": "",
				  "title": "",
				  "thumb": "",
				  "videos_yt_files": []
				},
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			var video_id = self.$route.params.video_id;
			
			apiIW.get('/videos_yt/' + video_id, {
				params: {
					join: [
						'videos_yt_files'
					]
				}
			}).then(function (response) {
				
				response.data.videos_yt_files.forEach(function(item){
					// item.title = decodeURIComponent(escape(item.title));
					item.title = item.title;
					item.webmv = item.file;
				})
				
				self.post = response.data;
				
				console.log(self.post);
				
				
				$(document).ready(function(){
					new jPlayerPlaylist({
						jPlayer: "#jquery_jplayer_1",
						cssSelectorAncestor: "#jp_container_1",
					}, self.post.videos_yt_files, {
						swfPath: "/cmr/includes/libs/Player-2.9.2/jplayer",
						supplied: "webmv, ogv, m4v",
						useStateClassSkin: true,
						autoBlur: false,
						smoothPlayBar: true,
						keyEnabled: true,
					})

				});
				
			}).catch(function (error) {
				// $.notify(error.response.code + error.response.message, "error");
			});
		},
		computed: {
		}
	});
	
	var Add_Video_YouTube = Vue.extend({
		template: '#page-add-video-youtube',
		data: function () {
			return {
				post: {
				  "error": false,
				  "id": 0,
				  "ref": this.$route.params.video_id,
				  "title": "",
				  "thumbnail": "",
				  "videos": [],
				  "message": "",
				  "messages": []
				},
				interval_active: false
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
				var video_id = self.$route.params.video_id;
				
				apiIW.get('/getVideoYT.php', {
					params: {
						videoid: video_id
					}
				}).then(function (response) {
					self.post = response.data;
					console.log(self.post);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			sendDataYT: function(){
				const self = this;
				var video_id = self.$route.params.video_id;
				console.log('Comenzando...');
				
				self.interval_active = true;
				console.log('Activando consulta cadenciada...');
				self.intervalid1 = setInterval(function(){
					console.log('Intervalos Activos...');
					if(self.interval_active == true){
						console.log('Buscando Cambios...');
						self.find();
					}else{
						console.log('Intervalos Inactivos...');
						clearInterval(self.intervalid1);
					}
				}, 5000);
			
				
				apiIW.get('/getVideoYT.php?copy=true&videoid=' + video_id + '&title=' + self.post.title)
				.then(function (response) {
					console.log('Terminado...');
					self.interval_active = false;
					self.find();
					
					console.log('Redireccionando...');
					location.replace('/#/view/video/' + self.post.id + '/');
					
					/*
					self.$router.push({
						name: 'view-video',
						params: {
							video_id: self.post.id
						}
					});
					*/
				}).catch(function (error) {
					console.log('Error...');
					self.interval_active = false;
					$.notify(error.response.data.code + error.response.data.message, "error");
					self.sendDataYT();
				});
				
			}
		}
	});
	
	// ------------ FIN -------------------------------------
	var router = new VueRouter({routes:[
		{ path: '/', component: Home, name: 'home'},
		{ path: '/view/video/:video_id', component: View_Video, name: 'view-video'},
		{ path: '/add/video/youtube/:video_id', component: Add_Video_YouTube, name: 'add-video-youtube'},
	]});

	var appRender = new Vue({
		data: function () {
			return {
			};
		},
		router:router,
		mounted: function () {
			var self = this;
		},
	}).$mount('#app');
</script>