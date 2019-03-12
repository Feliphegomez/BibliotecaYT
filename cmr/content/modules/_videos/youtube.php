<div>
	<div id="app">
		<div class="content_middle_box content">
		<router-view></router-view>
		</div>
	</div>
</div>	

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

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
								<button class="btn btn-lg btn-success" type="submit">Search</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="container">
			<hr>
			<div class="top_grid row">
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" v-for="(item, keyItem) in filteredposts">
					<div class="grid1">
						<div class="view view-first">
						  <div class="index_img"><img v-bind:src="item.thumb" class="img-fluid rounded mx-auto d-block" alt=""/></div>
							<div class="sale">{{ item.ref }}</div>
							  <div class="mask">
								<router-link tag="div" class="btn- btn-sm btn-secondary" :to="{ name: 'view-video', params: { video_id: item.id }}">
									<i class="search"> </i> Ver Video
								</router-link>
								
							   </div>
						   </div> 
						 <div class="inner_wrap">
							<h3>{{ item.title }}</h3>
						 </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</template>

<template id="page-view-video">
	<div>
		<section class="view intro-video">
			<div class="hm-gradient">
				<div class="full-bg-img">
					<div class="container flex-center">
						<div class="row pt-5 mt-3">
							<div class="col-lg-6 wow fadeIn mb-5 text-center text-lg-left">
								<div class="white-text">
									<h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">
										
										<router-link tag="button" class="btn btn-sm btn-info info" :to="{ name: 'home' }">
										Regresar
										</router-link>
										<br>
										
										{{ post.title }}
										
									</h1>
									<hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
									<p class="wow fadeInLeft" data-wow-delay="0.3s">
										
										<table class="table table-responsive text-left">
											<tr v-for="(item, keyItem) in post.videos_yt_files">
												<td>
													<a v-bind:href="item.file" class="btn btn-info">Descargar {{ item.type }}</a>
													
												</td>
												<td>{{ item.sizem }}</td>
											</tr>
										</table>
										
									</p>
								</div>
							</div>

							<div class="col-lg-6 wow fadeIn">
								<div id="jp_container_1" class="jp-video jp-video-480p" role="application" aria-label="media player">
									<div class="jp-type-playlist">
										<div id="jquery_jplayer_1" class="jp-jplayer" style="width:100%;"></div>
										<div class="jp-gui">
											<div class="jp-video-play">
												<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
											</div>
											<div class="jp-interface">
												<div class="jp-progress">
													<div class="jp-seek-bar">
														<div class="jp-play-bar"></div>
													</div>
												</div>
												<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
												<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
												<div class="jp-controls-holder">
													<div class="jp-controls">
														<button class="jp-previous" role="button" tabindex="0">previous</button>
														<button class="jp-play" role="button" tabindex="0">play</button>
														<button class="jp-next" role="button" tabindex="0">next</button>
														<button class="jp-stop" role="button" tabindex="0">stop</button>
													</div>
													<div class="jp-volume-controls">
														<button class="jp-mute" role="button" tabindex="0">mute</button>
														<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
														<div class="jp-volume-bar">
															<div class="jp-volume-bar-value"></div>
														</div>
													</div>
													<div class="jp-toggles">
														<button class="jp-repeat" role="button" tabindex="0">repeat</button>
														<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
														<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
													</div>
												</div>
												<div class="jp-details">
													<div class="jp-title" aria-label="title">&nbsp;</div>
												</div>
											</div>
										</div>
										<div class="jp-playlist">
											<ul>
												<!-- The method Playlist.displayPlaylist() uses this unordered list -->
												<li>&nbsp;</li>
											</ul>
										</div>
										<div class="jp-no-solution">
											<span>Update Required</span>
											To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<template id="page-add-video-youtube">
	<div>	
		<div class="container">
			<div class="col-lg-12">
				<i class="far fa-clock fa-4x" v-if="interval_active == true"></i>
				<h5 v-if="interval_active == true">Espere Por favor...</h5>
			<hr>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-responsive">
						<tr>
							<th>Video ID</th>
							<td>{{ post.ref }}</td>
						</tr>
						<tr>
							<th>Titulo</th>
							<td>{{ post.title }}</td>
						</tr>
					</table>
					<table class="table table-responsive">
						<tr>
							<th>Calidad</th>
							<th>Tipo de Video</th>
							<th>Tamaño en Mega Bytes</th>
							<th>Archivo Guardado</th>
						</tr>
						<tr v-for="item in post.videos">
							<td>{{ item.quality }}</td>
							<td>{{ item.extension }}</td>
							<td>{{ item.sizem }}</td>
							<td>
								<i class="fas fa-ban" v-if="item.copy == false"></i>
								<span v-if="item.copy == false">Esperando descarga.</span>
								
								<i class="fas fa-check" v-if="item.copy == true"></i>
								<span v-if="item.copy == true">Verificando...</span>
							</td>
						</tr>
					</table>
					<button class="btn btn-danger btn-md" type="button" @click="sendDataYT" v-if="post.id == 0 && interval_active == false">
						Comenzar Descarga
					</button>
					<button class="btn btn-success btn-md" type="button" v-if="post.id > 0 && interval_active == false">
						Ver Video en Galeria
					</button>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</template>
<style scope="page-view-video">
.hm-gradient .full-bg-img {
    background: -moz-linear-gradient(45deg, rgba(242, 34, 50, 0.5), rgba(255, 187, 54, 0.6) 100%);
    background: -webkit-linear-gradient(45deg, rgba(242, 34, 50, 0.5), rgba(255, 187, 54, 0.6) 100%);
    background: linear-gradient(to 45deg, rgba(29, 236, 197, 0.4), rgba(96, 0, 136, 0.4) 100%);
	border-radius: 35px;
}
@media (max-width: 740px) {
    .full-height,
    .full-height body,
    .full-height header,
    .full-height header .view {
        height: 700px;
    }
}
</style>

<style scope="page-list">
.form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
}
</style>