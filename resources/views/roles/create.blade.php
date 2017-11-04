@extends('layouts.app2')

@section('title', '| Adicionar Perfil')

@section('content')

<div class="col-lg-4 col-lg-offset-4">

    <h2><i class='fa fa-key'></i> Adicionar Perfil</h2>
    <hr>
    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome do perfil') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Associar Permissões</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
        @endforeach
    </div>

    {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection