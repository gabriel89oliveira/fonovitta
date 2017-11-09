@extends('layouts.app3')

@section('title', '| Criar Permissão')

@section('content')

<div class="col-lg-4 col-lg-offset-4">

    {{-- @include ('errors.list') --}}

    <h2>
	<i class='fa fa-key'></i> Criar Permissão
	</h2>
    
	<br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome da permissão') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>
    <br>

    @if(!$roles->isEmpty())

        <h4>Associar Permissão aos Perfis</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach

    @endif
    
    <br>
    {{ Form::submit('Criar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection