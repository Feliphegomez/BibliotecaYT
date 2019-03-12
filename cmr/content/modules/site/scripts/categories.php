<script>
	// ------------ INICIO ------------------------------------- 
	var Home = Vue.extend({
		template: '#page-home',
		data: function () {
			return {
				category_id: this.$route.params.category_id,
				posts: [],
				searchKey: '',
				list_categories: []
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.posts = [];
			
			self.loadCategoriesTree();
			apiIW.get('/videos_yt', {
				params: {
					filter: [
						'category,eq,' + self.category_id,
					],
					join: [
						// 'pictures',
						'videos_yt_files',
						'categories',
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
		},
		methods: {
			repairCategoryList: function (data){
				var self = this;
				var returnObj = {
					text: "",
					href: "/categories/index/#/" +  data.id,
					nodes: []
				};
				
				if(data.name){
					returnObj.text = data.name;
				}
				if(data.categories && data.categories.length > 0){
					data.categories.forEach(function(subitem){
						returnObj.nodes.push(self.repairCategoryList(subitem));
					})
				}
				return returnObj;
			},
			loadCategoriesTree: function (){
				var self = this;
				
				apiIW.get('/categories', {
					params: {
						filter: [
							// 'root,eq,1',
						],
						join: [
							 //'categories',
						],
					}
				}).then(function (response) {
					
					response.data.records.forEach(function(item){
						self.list_categories.push(self.repairCategoryList(item));
					});					
					
					/*
					$('#tree').treeview({
						data: self.list_categories,
						//levels: 5,
						// backColor: 'green'
					});
					*/
				}).catch(function (error) {
					// $.notify(error.response.code + error.response.message, "error");
				});
			
			
				/*
					{
						text: "Parent 1",
						icon: "fas fa-plus",
						selectedIcon: "fas fa-ban",
						color: "#000000",
						backColor: "#FFFFFF",
						href: "#node-1",
						selectable: true,
						state: {
							checked: true,
							disabled: false,
							expanded: true,
							selected: true
						},
						tags: [
							'available'
						],
						nodes: [
							{
								text: "Child 1",
								nodes: [
								]
							},
							{
							}
						]
					}
				*/
			}
		}
	});
	
	// ------------ FIN -------------------------------------
	var router = new VueRouter({routes:[
		{ path: '/:category_id', component: Home, name: 'home'},
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