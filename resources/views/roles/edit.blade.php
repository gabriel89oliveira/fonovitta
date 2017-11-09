@extends('layouts.app3')

@section('title', '| Editar Perfil')

@section('content')

<div class="col-lg-4 col-lg-offset-4">

    <h2><i class='fa fa-key'></i> Editar Perfil: {{$role->name}}</h2>
    <hr>
    {{-- @include ('errors.list') --}}
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome do perfil') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Associar Permissão</b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
    {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}    
</div>

@endsection