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
							<h3>Inventario</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table" >
						<thead class="thead-dark">
							<tr>
								<th scope="col" width="15%">Nombre</th>
								<th scope="col"  width="20%">Descripcion</th>
								<th scope="col"  width="10%">Marca</th>
								<th scope="col"  width="10%">serie</th>
								<th scope="col"  width="5%">Estatus</th>
								<th scope="col"  width="5%">Precio</th>
								<th scope="col"  width="15%">Imagen</th>
								<th scope="col"  width="15%">
									<button class="btn btn-primary pull-right" onclick="addupd()">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Agregar
									</button>
								</th>
							</tr>
						</thead>
						<tbody id="userTable">
							@foreach($articulos as $key => $articulo)
							<tr id="{{$key}}">
								<td>{{$articulo->nombre}}</td>
								<td>{{$articulo->descripcion}}</td>
								<td>{{$articulo->marca->nombre}}</td>
								<td>{{$articulo->serie}}</td>
								<td>{{$articulo->estatus}}</td>
								<td>{{$articulo->costo}}</td>
								<td>
									@if($articulo->imagen)
									{{$articulo->imagen}}
									@else
									no tiene imagen 
									@endif
								</td>
								<td>
									<a class="btn btn-primary" onclick='addupd({{$articulo}})'>
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
									<a class="btn btn-danger" onclick='destroy({{$articulo->id}},{{$key}})'>
										<i class="fa fa-trash" aria-hidden="true"></i>
									</a>
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
@include('articulos.addUpdArticulo')
@endsection
@section('script')
<script type="text/javascript">
	function addupd(data=0){
		$('#modalArticulo').modal('show');
	}
</script>
@endsection