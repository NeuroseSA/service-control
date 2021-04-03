@extends('layout.app', ["currentRoute" => "client"])

@section('body')

    <h2>Cadastro de clientes</h2>

    <form action="{{ route('client.new') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="CNPJ">CNPJ</label>
                <input type="text" class="form-control" placeholder="Informe o CNPJ" id="cnpj" name="cnpj"
                    value="{{ old('cnpj') }}" maxlength="18">
                    @error('cnpj') <div class="alert-danger"> <small> {{$message}} </small> </div> @enderror
            </div>
            <div class="col">
                <label for="">Razão Social</label>
                <input type="text" class="form-control" is-invalid placeholder="Up Tech - Soluções em TI" name="name"
                    value="{{ old('name') }}">
                    @error('name') <div class="alert-danger"> <small> {{$message}} </small> </div> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Contato</label>
                <input type="text" class="form-control" placeholder="(xx) xxxxx-xxxx" name="fone"
                    value="{{ old('fone') }}" maxlength="15" onkeypress="foneMask(this)">
                    @error('fone') <div class="alert-danger"> <small> {{$message}} </small> </div> @enderror
            </div>
            <div class="col">
                <label for="">E-mail</label>
                <input type="email" class="form-control" placeholder="contato@uptech.com.br" name="email"
                    value="{{ old('email') }}" onkeypress="emailValidate();">
                    @error('email') <div class="alert-danger"> <small> {{$message}} </small> </div> @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="">Endereço completo</label>
                <input type="text" class="form-control"
                    placeholder="Avenida Conde de Boa Vista, 2430 - Jardim Santa Emilia, Campo Grande/MS" name="address"
                    value="{{ old('address') }}">
                    @error('address') <div class="alert-danger"> <small> {{$message}} </small> </div> @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a type="button" class="btn btn-danger btn-sm" href="{{route('client.index')}}">Cancelar</a>
    </form>
@endsection
