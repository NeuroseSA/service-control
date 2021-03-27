@extends('layout.app', ["currentRoute" => "home"])

@section('body')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Painel de Ações</h1>

    </div>

    <div class="row row-cols-1 row-cols-md-3 mb-3 justify-content-center">

        <div class="col">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Clientes</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Aqui você pode cadastrar clientes.
                        Para que possíveis serviços sejam ofertados.
                    </p>
                    <a href="{{ route('client.index') }}" class="w-100 btn btn-lg btn-primary">Acesse</a>
                </div>

            </div>
        </div>

        <div class="col">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Serviços</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Aqui você pode visualizar e cadastrar novos serviços.
                        Também poderá gerir suas ordens de serviço.
                    </p>
                    <a href="{{ route('service.index') }}" class="w-100 btn btn-lg btn-primary">Acesse</a>
                </div>

            </div>
        </div>
        @if(Auth::user()->isAdmin)
        <div class="col">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Usuários</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Aqui você poderá gerir os técnicos que acessam o sistema e seus respectivos clientes.
                    </p>
                    <a href="{{ route('user.index') }}" class="w-100 btn btn-lg btn-primary">Acesse</a>
                </div>

            </div>
        </div>
        @endif
    </div>

@endsection
