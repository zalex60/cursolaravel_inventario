<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tituloModal">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{!! Form::open(array('url'=>'usuarios/store','method'=>'POST','id'=>'formUser')) !!}
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
						{!! Form::hidden('user_id', null, ['id'=> 'user_id'])!!}
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