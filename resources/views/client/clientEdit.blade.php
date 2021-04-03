@extends('layout.app', ["currentRoute" => "client"])

@section('body')

    <form action="{{ route('client.index') }}/{{ $cli->id }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="CNPJ">CNPJ</label>
                <input type="text" class="form-control" placeholder="Informe o CNPJ" name="cnpj"
                    value="{{ $cli->cnpj }}">
                @error('cnpj') <div class="alert-danger"> <small> {{ $message }} </small> </div> @enderror
            </div>
            <div class="col">
                <label for="">Razão Social</label>
                <input type="text" class="form-control" placeholder="Up Tech - Soluções em TI" name="name"
                    value="{{ $cli->name }}">
                @error('name') <div class="alert-danger"> <small> {{ $message }} </small> </div> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Contato</label>
                <input type="text" class="form-control" placeholder="(xx) xxxxx-xxxx" name="fone"
                    value="{{ $cli->fone }}">
                @error('fone') <div class="alert-danger"> <small> {{ $message }} </small> </div> @enderror
            </div>
            <div class="col">
                <label for="">E-mail</label>
                <input type="email" class="form-control" placeholder="contato@uptech.com.br" name="email"
                    value="{{ $cli->email }}">
                @error('email') <div class="alert-danger"> <small> {{ $message }} </small> </div> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="">Endereço completo</label>
                <input type="text" class="form-control"
                    placeholder="Avenida Conde de Boa Vista, 2430 - Jardim Santa Emilia, Campo Grande/MS" name="address"
                    value="{{ $cli->address }}">
                @error('address') <div class="alert-danger"> <small> {{ $message }} </small> </div> @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a type="button" href="{{ route('client.index') }}" class="btn btn-danger btn-sm">Cancelar</a>
    </form>
@endsection
