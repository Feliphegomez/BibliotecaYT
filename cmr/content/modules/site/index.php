<div>
	<div id="app">
		<div class="content_middle_box content">
		<router-view></router-view>
		</div>
	</div>
</div>	

<template id="page-home">
	<div>	
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<div class="card card-sm">
					<div class="card-body row no-gutters align-items-center">
						<div class="col-auto">
							<i class="fas fa-search h4 text-body"></i>
						</div>
						<div class="col">
							<input v-model="searchKey" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar temas o palabras clave">
						</div>
						<div class="col-auto">
							<button class="btn btn-lg btn-success" type="submit">Buscar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<hr>
			<div class="top_grid row">
				<div class="col-md-3 wow fadeIn mb-5">
					<h4>Categorias</h4>
					<ul class="list-group">
						<li class="list-group-item" v-for="c in list_categories">
							<a v-bind:href="c.href">{{ c.text }}</a>
						</li> 
					</ul>
				</div>
				<div class="col-md-9 wow fadeIn mb-5 row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" v-for="(item, keyItem) in filteredposts">
						<div class="grid1">
							<div class="view view-first">
								<div class="index_img">
									<a class="by" v-bind:href="'/video/youtube/#/' + item.id">
										<img v-bind:src="item.thumb" class="img-fluid rounded mx-auto d-block" alt=""/>
									</a>
								</div>
								<div class="sale">{{ item.category.name }}</div>
							</div> 
							<div class="inner_wrap">
								<h3>
									<a class="inner_wrap-title" v-bind:href="'/video/youtube/#/' + item.id">
									{{ item.title }}
									</a>
								</h3>
								<a target="_new" class="btn btn-sm btn-secondary fab fa-youtube" v-bind:href="'https://youtube.com/watch?v=' + item.ref"> </a>
							 </div>
						</div>
					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</template>

<style scope="page-list">
.form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
.index_img {
	cursor: pointer;
}
.inner_wrap-title {
	color: #646464;
	font-size: 1.3em;
	font-weight: 500;
	
}
</style>