<script>
	// ------------  INICIO ------------------------------------- 
	var List = Vue.extend({
		template: '#page',
		data: function () {
			return {
				posts: [],
				searchKey: ''
			};
		},
		create: function () {
			// $('#dataTable').DataTable();
		},
		mounted: function () {
			var self = this;
			self.posts = [];
			
			apiIW.get('/categories').then(function (response) {
				self.posts = response.data.records;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		computed: {
			filteredposts: function () {
				return this.posts.filter(function (post) {
					return this.searchKey=='' || post.name.indexOf(this.searchKey) !== -1;
				},this);
			}
		}
	});

	var View = Vue.extend({
		template: '#view',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
				var id = self.$route.params.id;
				
				apiIW.get('/categories/' + id).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Add = Vue.extend({
		template: '#add',
		data: function () {
			return {
				post: {
					id: 0,
					name: ''
				}
			}
		},
		methods: {
			create: function() {
				var post = this.post;
				apiIW.post('/categories', post).then(function (response) {
					post.id = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
					router.push('/');
			}
		}
	});

	var Edit = Vue.extend({
		template: '#edit',
		data: function () {
			return {
				post: {
					id: 0,
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			update: function () {
				var post = this.post;
				apiIW.put('/categories/' + post.id, post).then(function (response) {
					// console.log(response.data);
					$.notify("Guardado con éxito.", "success");
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			find: function(){
				var self = this;
				var id = self.$route.params.id;
				apiIW.get('/categories/' + id).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Delete = Vue.extend({
		template: '#delete',
		data: function () {
			return {
				post: {
					id: 0,
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			deleted: function () {
				var post = this.post;
				
				apiIW.delete('/categories/' + post.id).then(function (response) {
					console.log(response.data);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			},
			find: function(){
				var self = this;
				var id = self.$route.params.id;
				
				apiIW.get('/categories/' + id).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});
	// ------------  FIN -------------------------------------
	var router = new VueRouter({routes:[
		{ path: '/', component: List, name: 'List'},
		{ path: '/Add', component: Add, name: 'Add'},
		{ path: '/View/:id', component: View, name: 'View'},
		{ path: '/Edit/:id', component: Edit, name: 'Edit'},
		{ path: '/Delete/:id', component: Delete, name: 'Delete'},
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