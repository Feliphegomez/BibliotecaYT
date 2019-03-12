<div>
	<div id="app">
		<div class="content_middle_box content">
		<router-view></router-view>
		</div>
	</div>
</div>

<template id="page-add-video-youtube">
	<div>	
		<div class="container">
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
								
								<span v-if="item.size <= 0"><br>No se puede descargar, intente actualizando la página nuevamente, si el problema persiste es porque este video tiene derechos de autor y/o privacidad que no pueden ser omitidos ...</span>
							</td>
						</tr>
					</table>
					<button class="btn btn-danger btn-md" type="button" @click="sendDataYT" v-if="post.error == false && post.id == 0 && interval_active == false">
						Comenzar Descarga
					</button>
					
					<a v-bind:href="'/video/youtube/#/' + item.id" v-if="post.error == false && post.id > 0 && interval_active == false" class="btn btn-success btn-md">
						Ver Video en Galeria
					</a>
				</div>
				<div class="col-lg-12" v-if="interval_active == true">
					<hr>
					<h4 class="text-center">Espere Por favor...</h4>
					
					<hr>
					<div class="sk-folding-cube">
					  <div class="sk-cube1 sk-cube"></div>
					  <div class="sk-cube2 sk-cube"></div>
					  <div class="sk-cube4 sk-cube"></div>
					  <div class="sk-cube3 sk-cube"></div>
					</div>
					
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</template>

<style scope="page-add-video-youtube">
.sk-folding-cube {
  margin: 20px auto;
  width: 40px;
  height: 40px;
  position: relative;
  -webkit-transform: rotateZ(45deg);
          transform: rotateZ(45deg);
}

.sk-folding-cube .sk-cube {
  float: left;
  width: 50%;
  height: 50%;
  position: relative;
  -webkit-transform: scale(1.1);
      -ms-transform: scale(1.1);
          transform: scale(1.1); 
}
.sk-folding-cube .sk-cube:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #333;
  -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
          animation: sk-foldCubeAngle 2.4s infinite linear both;
  -webkit-transform-origin: 100% 100%;
      -ms-transform-origin: 100% 100%;
          transform-origin: 100% 100%;
}
.sk-folding-cube .sk-cube2 {
  -webkit-transform: scale(1.1) rotateZ(90deg);
          transform: scale(1.1) rotateZ(90deg);
}
.sk-folding-cube .sk-cube3 {
  -webkit-transform: scale(1.1) rotateZ(180deg);
          transform: scale(1.1) rotateZ(180deg);
}
.sk-folding-cube .sk-cube4 {
  -webkit-transform: scale(1.1) rotateZ(270deg);
          transform: scale(1.1) rotateZ(270deg);
}
.sk-folding-cube .sk-cube2:before {
  -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s;
}
.sk-folding-cube .sk-cube3:before {
  -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s; 
}
.sk-folding-cube .sk-cube4:before {
  -webkit-animation-delay: 0.9s;
          animation-delay: 0.9s;
}
@-webkit-keyframes sk-foldCubeAngle {
  0%, 10% {
    -webkit-transform: perspective(140px) rotateX(-180deg);
            transform: perspective(140px) rotateX(-180deg);
    opacity: 0; 
  } 25%, 75% {
    -webkit-transform: perspective(140px) rotateX(0deg);
            transform: perspective(140px) rotateX(0deg);
    opacity: 1; 
  } 90%, 100% {
    -webkit-transform: perspective(140px) rotateY(180deg);
            transform: perspective(140px) rotateY(180deg);
    opacity: 0; 
  } 
}

@keyframes sk-foldCubeAngle {
  0%, 10% {
    -webkit-transform: perspective(140px) rotateX(-180deg);
            transform: perspective(140px) rotateX(-180deg);
    opacity: 0; 
  } 25%, 75% {
    -webkit-transform: perspective(140px) rotateX(0deg);
            transform: perspective(140px) rotateX(0deg);
    opacity: 1; 
  } 90%, 100% {
    -webkit-transform: perspective(140px) rotateY(180deg);
            transform: perspective(140px) rotateY(180deg);
    opacity: 0; 
  }
}
</style>