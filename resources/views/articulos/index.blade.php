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
								<th scope="col"  width="15%">Marca</th>
								<th scope="col"  width="10%">serie</th>
								<th scope="col"  width="5%">Cantidad</th>
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
								<td align='right'>{{$articulo->cantidad}}</td>
								<td align='right'>${{number_format($articulo->costo,2)}}</td>
								<td>{{$articulo->imagen}}</td>
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
	window.setTimeout(function() {
		$("#message_infoSucces").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
		});
	}, 3000);
	function addupd(data=0){
		$('#nombre').val(data ? data.nombre:'');
		$('#descripcion').val(data ? data.descripcion:'');
		$('#area_id').val(data ? data.area_id:'');
		$('#estado').val(data ? data.estado:'');
		$('#serie').val(data ? data.serie:'');
		$('#cantidad').val(data ? data.cantidad:'');
		$('#costo').val(data ? data.costo:'');
		$('#marca_id').val(data ? data.marca_id:'');
		$('#articulo_id').val(data ? data.id:'');
		document.getElementById('tituloModal').innerHTML = data ? 'Editar Usuario <small class="m-0 text-muted">*Completa el formulario</small>':'Agregar Usuario <small class="m-0 text-muted">*Completa el formulario</small>';
		document.getElementById('formUser').action= data ? "{{ url('articulos/update') }}":"{{ url('articulos/store') }}";
		$('#modalArticulo').modal('show');
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
				axios.delete('{{ url('articulos/destroy') }}'+'/'+id).then(response =>{
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