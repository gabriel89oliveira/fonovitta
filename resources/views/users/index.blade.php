@extends('layouts.app2')

@section('title', '| Usuários')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h2>
		<i class="fa fa-users"></i> Administração de Usuários 
		<a href="{{ route('roles.index') }}" class="btn btn-default pull-right ma-5">Perfis</a>
		<a href="{{ route('permissions.index') }}" class="btn btn-default pull-right ma-5">Permissões</a>
	</h2>
    
	<hr>
    <div class="table-responsive">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfis do usuário</th>
                    <th></th>
					<th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)

                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>
					</td>
					
					<td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Usuário</a>

</div>

@endsection