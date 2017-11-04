@extends('layouts.app2')

@section('title', '| Editar Permissão')

@section('content')

<div class="col-lg-4 col-lg-offset-4">

    {{-- @include ('errors.list') --}}

    <h2><i class='fa fa-key'></i> Editar '{{$permission->name}}'</h2>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome da Permissão') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection