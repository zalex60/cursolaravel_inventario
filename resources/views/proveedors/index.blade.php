@extends('layouts.app')

@section('title', __('proveedor.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Proveedor)
            <a href="{{ route('proveedors.create') }}" class="btn btn-success">{{ __('proveedor.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('proveedor.list') }} <small>{{ __('app.total') }} : {{ $proveedors->total() }} {{ __('proveedor.proveedor') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('proveedor.search') }}</label>
                        <input placeholder="{{ __('proveedor.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('proveedor.search') }}" class="btn btn-secondary">
                    <a href="{{ route('proveedors.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('proveedor.name') }}</th>
                        <th>{{ __('proveedor.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedors as $key => $proveedor)
                    <tr>
                        <td class="text-center">{{ $proveedors->firstItem() + $key }}</td>
                        <td>{!! $proveedor->name_link !!}</td>
                        <td>{{ $proveedor->description }}</td>
                        <td class="text-center">
                            @can('view', $proveedor)
                                <a href="{{ route('proveedors.show', $proveedor) }}" id="show-proveedor-{{ $proveedor->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $proveedors->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
