@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div>
					@if($errors->any())
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<ul>
							@foreach ($errors->all() as $error)
							<li><p>{!! $error !!}</p></li>
							@endforeach
						</ul>
					</div>
					@endif
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
									<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalUsuario" onclick="addupd()">
										Agregar usuarios
									</button>
								</th>
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
							@if ($errors->has('nombre'))
							<small class="text-danger">
								<strong>{{ $errors->first('nombre') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-6">
							{{Form::label('email', 'E-Mail Address')}}
							{!! Form::email('email', null, ['class'=>'form-control', 'id' => 'email'])!!}
							@if ($errors->has('email'))
							<small class="text-danger">
								<strong>{{ $errors->first('email') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-6">
							{{Form::label('perfil_id', 'Perfil')}}
							{!!Form::select('perfil_id', $perfiles, null,['class'=>'form-control','placeholder'=>'Perfiles', 'required', 'id' => 'perfil_id'])!!}
							@if ($errors->has('perfil_id'))
							<small class="text-danger">
								<strong>{{ $errors->first('perfil_id') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-6">
							{{Form::label('area_id', 'Area')}}
							{!!Form::select('area_id', $areas, null,['class'=>'form-control','placeholder'=>'Areas', 'required', 'id' => 'area_id'])!!}
							@if ($errors->has('area_id'))
							<small class="text-danger">
								<strong>{{ $errors->first('area_id') }}</strong>
							</small>
							@endif
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