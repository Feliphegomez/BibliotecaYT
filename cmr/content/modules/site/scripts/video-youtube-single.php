<script>
	// ------------ INICIO ------------------------------------- 	
	var View_Video = Vue.extend({
		template: '#page-view-video',
		data: function () {
			return {
				post: {
				  "id": this.$route.params.video_id,
				  "ref": "",
				  "title": "",
				  "thumb": "",
				  "category": {
					"id": 0,
					"root": null,
					"name": "",
					"categories": []
				  },
				  "videos_yt_files": []
				},
				list_categories: []
			};
		},
		create: function () {
			console.log('creando...');
		},
		mounted: function () {
			var self = this;
			self.loadCategoriesTree();
			self.find();
		},
		computed: {
		},
		methods: {
			find: function(){
				var self = this;
				var video_id = self.$route.params.video_id
				apiIW.get('/videos_yt/' + video_id, {
					params: {
						join: [
							'videos_yt_files',
							'categories',
							'categories,categories',
						]
					}
				}).then(function (response) {
					response.data.videos_yt_files.forEach(function(item){
						item.webmv = item.file;
					});
					self.post = response.data;
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
					
				}).catch(function (error) { self.$parent.decodeError(error.response.data); });
			},
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
				}).catch(function (error) { self.$parent.decodeError(error.response.data); });
			
			
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
			},
			changeTitleVideoYT: function(){
				var self = this;

				bootbox.prompt({
					title: "Cambiar Titulo",
					inputType: 'textarea',
					value: self.post.title,
					callback: function (result) {
						if(
							result != ''
							&& result != ' '
							&& result != '  '
							&& result != null
						)
						{
							console.log("Actualizando Titulo");
							self.post.title = result;
							
							apiIW.put('/videos_yt/' + self.post.id, {
								id: self.post.id,
								title: self.post.title,
								thumb: self.post.thumb,
								ref: self.post.ref,
							}).then(function (response) {
								console.log(response.data);
								window.location.reload();
							}).catch(function (error) { self.$parent.decodeError(error.response.data); });
						}
					}
				});
			},
			changeCategoryVideoYT: function(){
				var self = this;
				
				apiIW.get('/categories', { params: {} })
				.then(function (response) {
					var list = [];
					response.data.records.forEach(function(item){
						list.push({
							text: item.name,
							value: item.id
						});
					});
					
					bootbox.prompt({
						title: "Cambiar Categoria",
						inputType: 'select',
						value: self.post.category.id,
						inputOptions: list,
						callback: function (result) {
							if(
								result != ''
								&& result != ' '
								&& result != '  '
								&& result != null
							)
							{
								self.post.category.id = result;
								apiIW.put('/videos_yt/' + self.post.id, {
									id: self.post.id,
									category: self.post.category.id,
									thumb: self.post.thumb,
									ref: self.post.ref,
								}).then(function (response) {
									console.log(response.data);
									window.location.reload();
								}).catch(function (error) { self.$parent.decodeError(error.response.data); });
							}
						}
					});
				})
				.catch(function (error) { self.$parent.decodeError(error.response.data); });
					
			},
		}
	});
	// ------------ FIN -------------------------------------
	var router = new VueRouter({routes:[
		{ path: '/:video_id', component: View_Video, name: 'view-video'},
	]});

	var appRender = new Vue({
		data: function () {
			return {
				lists_errors_API: {
					1000: "Ruta no encontrada",
					1001: "Tabla no encontrada",
					1002: "Discrepancia en el recuento de argumentos",
					1003: "Registro no encontrado",
					1004: "El origen esta prohibido",
					1005: "Columna no encontrada",
					1006: "Tabla ya existe",
					1007: "La columna ya existe",
					1008: "No se puede leer el mensaje HTTP",
					1009: "Excepción de clave duplicada",
					1010: "Violación de integridad de datos",
					1011: "Autenticacion requerida",
					1012: "Autenticación fallida",
					1013: "La validación de entrada falló",
					1014: "Operación prohibida",
					1015: "Operación no soportada",
					1016: "Temporal o permanentemente bloqueado",
					1017: "Token XSRF malo o faltante",
					1018: "Solo se permiten peticiones AJAX",
					1019: "Paginación Prohibida",
					9999: "Error desconocido"
				}
			};
		},
		router:router,
		mounted: function () {
			var self = this;
		},
		methods: {
			decodeError: function(err){
				var self = this;		
				$.notify(self.lists_errors_API[err.code], "error");
				/* Soluciones recomendadas */
				switch(err.code) {
				  case 1010:
					$.notify("Verifique que los datos esten ingresados de manera correcta.", "warning");
					break;
				  default:
					break;
				}

			},
		}
	}).$mount('#app');
</script>