@extends('layout.app', ["currentRoute" => "client"])

@section('body')

<h1>Index Client</h1>



<div class="card border">
    <div class="card-footer">
        <a href="{{ route('client.new') }}" class="btn btn-primary btn-sm">Cadastrar</a>
        <a href="{{ route('client.export') }}" class="btn btn-primary btn-sm">Exportar</a>
    </div>
    <div class="card-body">
        <h4>Todos os Clientes</h4>
        @if (count($listClient) > 0)

            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>CNPJ do cliente</th>
                        <th>Razão Social</th>
                        <th>Contato</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listClient as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->cnpj }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->fone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a href="/cliente/editar/{{ $item->id }}" class="btn btn-sm btn-primary">Editar</a>
                                <a href="/cliente/apagar/{{ $item->id }}" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <div class="card-footer">
                {{ $listClient->links() }}
            </div>
    </div>
</div>

@endsection
