@extends('layout.app', ["currentRoute" => "client"])

@section('body')

<h2>Cadastro de clientes</h2>

    <form action="{{ route('client.new') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <label for="CNPJ">CNPJ</label>
                <input type="text" class="form-control" placeholder="Informe o CNPJ" name="cnpj" value="{{old('cnpj')}}">
            </div>
            <div class="col">
                <label for="">Razão Social</label>
                <input type="text" class="form-control" placeholder="Up Tech - Soluções em TI" name="name" value="{{old('name')}}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Contato</label>
                <input type="text" class="form-control" placeholder="(xx) xxxxx-xxxx" name="fone" value="{{old('fone')}}">
            </div>
            <div class="col">
                <label for="">E-mail</label>
                <input type="email" class="form-control" placeholder="contato@uptech.com.br" name="email" value="{{old('email')}}">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="">Endereço completo</label>
                <input type="text" class="form-control"
                    placeholder="Avenida Conde de Boa Vista, 2430 - Jardim Santa Emilia, Campo Grande/MS" name="address" value="{{old('address')}}">
            </div>
        </div>
        <br>        
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
    </form>
    @if ($errors->any())
    <div class="card-footer">
        @foreach ($errors->all() as $errors)
            <div class="alert alert-danger" role="alert">
                {{ $errors }}
            </div>
        @endforeach
    </div>
@endif
@endsection
