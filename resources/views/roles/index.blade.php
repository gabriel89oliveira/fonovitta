@extends('layouts.app3')

@section('title', '| Perfil')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    
    <h2>
		<i class="fa fa-key"></i> Perfil
		<a href="{{ route('users.index') }}" class="btn btn-default pull-right ma-5">Usuários</a>
		<a href="{{ route('permissions.index') }}" class="btn btn-default pull-right ma-5">Permissões</a>
	</h2>
	
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            
            <thead>
                <tr>
                    <th>Perfil</th>
                    <th>Permissão</th>
                    <th>Operação</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td><pre>{{  $role->permissions()->orderBy('name', 'asc')->pluck('name')->implode(" \n ") }}</pre></td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'onsubmit' => 'return confirm("Deseja excluir esse perfil?") ' ]) !!}
						{!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-primary">Adicionar Perfil</a>

</div>

@endsection