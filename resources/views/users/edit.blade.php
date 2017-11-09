@extends('layouts.app3')

@section('title', '| Editar Usuário')

@section('content')

<div class="col-lg-4 col-lg-offset-4">

    <h2><i class='fa fa-user-plus'></i> Editar '{{$user->name}}'</h2>
    <hr>
    {{-- @include ('errors.list') --}}

    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'Nome') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Associar perfil</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection