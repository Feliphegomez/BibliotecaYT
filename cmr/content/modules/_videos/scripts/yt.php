<script>
	var Add_Video_YouTube = Vue.extend({
		template: '#page-add-video-youtube',
		data: function () {
			return {
				post: {
				  "error": false,
				  "id": 0,
				  "ref": "",
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
				}).catch(function (error) {
					console.log('Error...');
					self.interval_active = false;
					$.notify(error.response.data.code + error.response.data.message, "error");
					self.sendDataYT();
				});
				
			}
		}
	});
	
	var router = new VueRouter({routes:[
		{ path: '/:video_id', component: Add_Video_YouTube, name: 'add-video-youtube'},
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