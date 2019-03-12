<div>
	<div id="app">
		<div class="content_middle_box content">
		<router-view></router-view>
		</div>
	</div>
</div>	

<template id="page-view-video">
	<div>
		<section class="intro-video">
			<div class="hm-gradient">
				<div class="full-bg-img container">
					<div class="flex-center white-text">
						<h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">
							<a class="btn- btn-sm btn-info info" href="/index/">
								Regresar
							</a>
							{{ post.title }}
							<span class="fas fa-edit" @click="changeTitleVideoYT"></span>
						</h1>
						<hr class="hr-dark wow fadeInLeft" data-wow-delay="0.3s">
					</div>
					<div class="flex-center">
						<div class="pt-5 pb-5 mt-5 mt-lg-0 ">
							<div class="row">
								<div class="col-lg-7 wow fadeIn mb-5 text-center text-lg-left">
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
								<div class="col-lg-5 wow fadeIn mb-5 text-center text-lg-left">
									<div class="white-text">
										<h4>
											<span class="fas fa-edit" @click="changeCategoryVideoYT"></span>
											<b>Categoria: </b>
											<small>
												{{ post.category.name }}
											</small>
										</h4>
										
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
								<div class="col-lg-12 wow fadeIn mb-5">
									<h4>Categoria Relacionadas</h4>
									<ul class="list-group">
										<li class="list-group-item" v-for="c in list_categories">
											<a v-bind:href="c.href">{{ c.text }}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
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