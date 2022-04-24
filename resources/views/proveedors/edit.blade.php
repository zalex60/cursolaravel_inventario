@extends('layouts.app')

@section('title', __('proveedor.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $proveedor)
        @can('delete', $proveedor)
            <div class="card">
                <div class="card-header">{{ __('proveedor.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('proveedor.name') }}</label>
                    <p>{{ $proveedor->name }}</p>
                    <label class="form-label text-primary">{{ __('proveedor.description') }}</label>
                    <p>{{ $proveedor->description }}</p>
                    {!! $errors->first('proveedor_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('proveedor.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('proveedors.destroy', $proveedor) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="proveedor_id" type="hidden" value="{{ $proveedor->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('proveedors.edit', $proveedor) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('proveedor.edit') }}</div>
            <form method="POST" action="{{ route('proveedors.update', $proveedor) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('proveedor.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $proveedor->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('proveedor.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $proveedor->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('proveedor.update') }}" class="btn btn-success">
                    <a href="{{ route('proveedors.show', $proveedor) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $proveedor)
                        <a href="{{ route('proveedors.edit', [$proveedor, 'action' => 'delete']) }}" id="del-proveedor-{{ $proveedor->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
