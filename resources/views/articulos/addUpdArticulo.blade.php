<div class="modal fade" id="modalArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tituloModal">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{!! Form::open(array('url'=>'articulos/store','method'=>'POST','id'=>'formUser', 'enctype' => 'multipart/form-data',)) !!}
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
							{{Form::label('descripcion', 'Descripcion')}}
							{!! Form::text('descripcion', null, ['class'=>'form-control', 'id' => 'descripcion'])!!}
							@if ($errors->has('descripcion'))
							<small class="text-danger">
								<strong>{{ $errors->first('descripcion') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('serie', 'Serie')}}
							{!! Form::text('serie', null, ['class'=>'form-control', 'id' => 'serie'])!!}
							@if ($errors->has('serie'))
							<small class="text-danger">
								<strong>{{ $errors->first('serie') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('cantidad', 'Cantidad')}}
							{!! Form::number('cantidad', null, ['class'=>'form-control', 'id' => 'cantidad'])!!}
							@if ($errors->has('cantidad'))
							<small class="text-danger">
								<strong>{{ $errors->first('cantidad') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('costo', 'Costo')}}
							{!! Form::number('costo', null, ['class'=>'form-control', 'id' => 'costo'])!!}
							@if ($errors->has('costo'))
							<small class="text-danger">
								<strong>{{ $errors->first('costo') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('estado', 'Estado')}}
							{!!Form::select('estado', [1=>'Nuevo',2=>'Usado',3=>'Renovado',4=>'Caja Abierta'], null,['class'=>'form-control','placeholder'=>'Estado', 'required', 'id' => 'estado'])!!}
							@if ($errors->has('estado'))
							<small class="text-danger">
								<strong>{{ $errors->first('estado') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('area_id', 'Areas')}}
							{!!Form::select('area_id', $areas, null,['class'=>'form-control','placeholder'=>'Areas', 'required', 'id' => 'area_id'])!!}
							@if ($errors->has('area_id'))
							<small class="text-danger">
								<strong>{{ $errors->first('area_id') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-4">
							{{Form::label('marca_id', 'Marca')}}
							{!!Form::select('marca_id', $marcas, null,['class'=>'form-control','placeholder'=>'Marcas', 'required', 'id' => 'marca_id'])!!}
							@if ($errors->has('marca_id'))
							<small class="text-danger">
								<strong>{{ $errors->first('marca_id') }}</strong>
							</small>
							@endif
						</div>
						<div class="col-md-12">
							{{Form::label('imagen', 'Imagen')}}
							{!! Form::file('imagen', ["class" => "form-control"])!!}
							@if ($errors->has('imagen'))
							<small class="text-danger">
								<strong>{{ $errors->first('imagen') }}</strong>
							</small>
							@endif
						</div>
						
						{!! Form::hidden('articulo_id', null, ['id'=> 'articulo_id'])!!}
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