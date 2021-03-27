@extends('layout.app', ["currentRoute" => "user"])

@section('body')

    <h2>Edição de Usuários</h2>

    <form action="/usuario/{{$user->id}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="CPF">CPF</label>
                <input type="text" class="form-control" placeholder="Informe o CPF" name="cpf" value="{{$user->cpf }}">
            </div>
            <div class="col">
                <label for="">Nome completo</label>
                <input type="text" class="form-control" placeholder="Alex Junior Pinto dos Santos" name="name"
                    value="{{$user->name }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Contato</label>
                <input type="text" class="form-control" placeholder="(xx) xxxxx-xxxx" name="fone"
                    value="{{$user->fone }}">
            </div>
            <div class="col">
                <label for="">E-mail</label>
                <input type="email" class="form-control" placeholder="contato@uptech.com.br" name="email"
                    value="{{$user->email }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Senha de acesso</label>
                <input type="password" class="form-control" placeholder="" name="password"
                    value="{{$user->password }}">
            </div>
            <div class="col">
                <label for="">Clientes do usuário</label>
                <div class="row">
                    <div class="col">
                        @foreach ($clients as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  name="clientsUser[]" value="{{$item->id}}" @foreach ($listClient as $item2) @if ($item2->name == $item->name)
                                checked
                            @endif
                            @endforeach>
                            <label class="form-check-label" for="">
                                <span id="acao">{{$item->name}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
    </form>
@endsection
