@extends('layouts.app')

@section('title', __('proveedor.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('proveedor.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('proveedor.name') }}</td><td>{{ $proveedor->name }}</td></tr>
                        <tr><td>{{ __('proveedor.description') }}</td><td>{{ $proveedor->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $proveedor)
                    <a href="{{ route('proveedors.edit', $proveedor) }}" id="edit-proveedor-{{ $proveedor->id }}" class="btn btn-warning">{{ __('proveedor.edit') }}</a>
                @endcan
                <a href="{{ route('proveedors.index') }}" class="btn btn-link">{{ __('proveedor.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
