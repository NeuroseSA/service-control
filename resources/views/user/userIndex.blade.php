@extends('layout.app', ["currentRoute" => "user"])

@section('body')

<h1>Usuários</h1>



<div class="card border">
    <div class="card-footer">
        <a href="{{ route('user.new') }}" class="btn btn-primary btn-sm">Cadastrar</a>
    </div>
    <div class="card-body">
        <h4>Todos os Usuários</h4>
        @if (count($listUser) > 0)

            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listUser as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->cpf }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->fone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="/usuario/editar/{{ $item->id }}" class="btn btn-sm btn-primary" style="width: 70px">Editar</a>
                                <a href="/usuario/apagar/{{ $item->id }}" class="btn btn-sm btn-danger" style="width: 70px">Apagar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <div class="card-footer">
                {{ $listUser->links() }}
            </div>
    </div>
</div>

@endsection
