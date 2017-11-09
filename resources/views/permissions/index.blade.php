@extends('layouts.app3')

@section('title', '| Permissão')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <h2>
	<i class="fa fa-key"></i>Permissões disponíveis
    <a href="{{ route('users.index') }}" class="btn btn-default pull-right ma-5">Usuários</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right ma-5">Perfis</a>
	</h2>
    
	<hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissão</th>
                    <th>Operação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'onsubmit' => 'return confirm("Deseja excluir essa permissão?") ' ]) !!}
						{!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ URL::to('permissions/create') }}" class="btn btn-primary">Adicionar Permissão</a>

</div>

@endsection