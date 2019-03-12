<div>
	<div id="app">
		<div>
			<div id="preload"></div>
			<div class="container_not">
				<main>
					<router-view></router-view>
				</main>
			</div>
		</div>
	</div>
</div>
<!-- // ------------ INICIO -------------------------------------  -->
<template id="page">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable_" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Actions</th>
							</tr>
						</tfoot>
						<tbody>
							<tr v-if="posts===null">
								<td colspan="4">Loading...</td>
							</tr>
							<tr v-else v-for="post in filteredposts">
								<td>{{ post.id }}</td>
								<td>{{ post.name }}</td>
								<td>
									<router-link class="btn btn-info btn-md text-white" v-bind:to="{name: 'View', params: { id: post.id }}"><i class="fas fa-eye"></i> </router-link>
									<router-link class="btn btn-warning btn-md text-white" v-bind:to="{name: 'Edit', params: { id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
									<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Delete', params: { id: post.id }}"><i class="fa fa-trash"></i> </router-link>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
	
<template id="view">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<th>ID INTERNO</th>
						<td>{{ post.id }}</td>
					</tr>
					<tr>
						<th>NOMBRE</th>
						<td>{{ post.name }}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="create">
					<div class="form-group">
						<label for="add-content">Nombre</label>
						<input class="form-control" type="text" v-model="post.name" />
					</div>
					<button type="submit" class="btn btn-primary">Crear</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="update">
					<div class="form-group">
						<label for="edit-content">Nombre</label>
						<input class="form-control" id="edit-content" v-model="post.name" />
					</div>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="deleted">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------  FIN -------------------------------------  -->
