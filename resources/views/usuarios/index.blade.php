@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div>
					<div class="card-header">
						<div class="col-md-12">
							
							Usuarios
							<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalUsuario" onclick="addupd()">
								Agregar usuarios
							</button>
							
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Email</th>
							<th scope="col">Perfil</th>
							<th scope="col">Area</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
						<tr>
							<td>{{$usuario->name}}</td>
							<td>{{$usuario->email}}</td>
							<td>{{$usuario->perfil->nombre}}</td>
							<td>{{$usuario->area->nombre}}</td>
							<td>
								<button class="btn btn-primary">
									Editar
								</button>
								<button class="btn btn-danger">
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

@endsection
@section('modals')
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{!! Form::open(array('url'=>'usuarios/store','method'=>'POST')) !!}
			{!! csrf_field() !!}
			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							{{Form::label('nombre', 'Nombre')}}
							{!! Form::text('nombre', null, ['class'=>'form-control', 'id' => 'nombre'])!!}
						</div>
						<div class="col-md-6">
							{{Form::label('email', 'E-Mail Address')}}
							{!! Form::text('email', null, ['class'=>'form-control', 'id' => 'email'])!!}
						</div>
						<div class="col-md-6">
							{{Form::label('perfil_id', 'Perfil')}}
							{!!Form::select('perfil_id', $perfiles, null,['class'=>'form-control','placeholder'=>'Perfiles', 'required', 'id' => 'perfil_id'])!!}
						</div>
						<div class="col-md-6">
							{{Form::label('area_id', 'Area')}}
							{!!Form::select('area_id', $areas, null,['class'=>'form-control','placeholder'=>'Areas', 'required', 'id' => 'area_id'])!!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	function addupd(){

	}
</script>
@endsection