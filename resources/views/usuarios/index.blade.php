@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div>
					@include('errors.formErrors')
					<div class="card-header">
						<div class="col-md-12" align="center">
							<h3>Usuarios</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table" >
						<thead class="thead-dark">
							<tr>
								<th scope="col" width="25%">Nombre</th>
								<th scope="col"  width="20%">Email</th>
								<th scope="col"  width="15%">Perfil</th>
								<th scope="col"  width="15%">Area</th>
								<th scope="col"  width="15%">
									<button class="btn btn-primary pull-right" onclick="addupd()">
										Agregar usuarios
									</button>
								</th>
							</tr>
						</thead>
						<tbody id="userTable">
							@foreach($usuarios as $key => $usuario)
							<tr id="{{$key}}">
								<td>{{$usuario->name}}</td>
								<td>{{$usuario->email}}</td>
								<td>{{$usuario->perfil->nombre}}</td>
								<td>{{$usuario->area->nombre}}</td>
								<td>
									<button class="btn btn-primary" onclick='addupd({{$usuario}})'>
										Editar
									</button>
									<button class="btn btn-danger" onclick='destroy({{$usuario->id}},{{$key}})' {{\Auth::user()->id==$usuario->id ? 'disabled':''}}>
										Eliminar
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('modals')
@include('usuarios.addUpdUser')
@endsection
@section('script')
<script type="text/javascript">
	function addupd(data=0){
		$('#nombre').val(data ? data.name:'');
		$('#email').val(data ? data.email:'');
		$('#area_id').val(data ? data.area_id:'');
		$('#perfil_id').val(data ? data.perfil_id:'');
		$('#user_id').val(data ? data.id:null);
		document.getElementById('tituloModal').innerHTML = data ? 'Editar Usuario <small class="m-0 text-muted">*Completa el formulario</small>':'Agregar Usuario <small class="m-0 text-muted">*Completa el formulario</small>';
		document.getElementById('formUser').action= data ? "{{ url('usuarios/update') }}":"{{ url('usuarios/store') }}";
		$('#modalUsuario').modal('show');
	}

	function destroy(id,index){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				axios.delete(`destroy/${id}`).then(response =>{
					if(response.data.status){
						Swal.fire(
							'¡Eliminadó!',
							response.data.message,
							'success'
							)
						$(`#${index}`).remove();
					}else{
						Swal.fire(
							'¡Error!',
							response.data.message,
							'warning'
							)
					}
				});
			}
		})
	}
</script>
@endsection