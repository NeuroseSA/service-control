@extends('layout.app', ["currentRoute" => "user"])

@section('body')

    <h2>Cadastro de Usuários</h2>

    <form action="/usuario/novo" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="CPF">CPF</label>
                <input type="text" class="form-control" placeholder="Informe o CPF" name="cpf" value="{{ old('cpf') }}">
            </div>
            <div class="col">
                <label for="">Nome completo</label>
                <input type="text" class="form-control" placeholder="Alex Junior Pinto dos Santos" name="name"
                    value="{{ old('name') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Contato</label>
                <input type="text" class="form-control" placeholder="(xx) xxxxx-xxxx" name="fone"
                    value="{{ old('fone') }}">
            </div>
            <div class="col">
                <label for="">E-mail</label>
                <input type="email" class="form-control" placeholder="contato@uptech.com.br" name="email"
                    value="{{ old('email') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Senha de acesso</label>
                <input type="password" class="form-control" placeholder="" name="password"
                    value="{{ old('password') }}">
            </div>
            <div class="col">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
    </form>
@endsection
