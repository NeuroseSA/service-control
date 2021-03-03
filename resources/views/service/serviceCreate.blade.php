@extends('layout.app', ["currentRoute" => "service"])

@section('body')

    <h2>Nova ordem de serviço</h2>

    <form id="formOrder">
        <h3>Ordem #{{ $order_id }} </h3>
        @csrf
        <input type="hidden" name="order" id="order" value="{{ $order_id }}">
        <div class="row">
            <div class="col">
                <label for="">Tomador de Serviço</label>
                <select class="form-control" name="client" id="client">
                    <option selected>Selecione</option>
                    @foreach ($listClients as $item)
                        <option>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="">Quantidade</label>
                <input type="number" class="form-control" placeholder="" name="amount" id="amount"
                    value="{{ old('amount') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="CNPJ">Tipo de serviços</label>
                <select class="form-control" name="category" id="category">
                    <option selected>Formatação</option>
                    <option>Formatação e Manutenção Preventiva</option>
                    <option>Concerto</option>
                </select>
            </div>
            <div class="col">
                <label for="">Valor</label>
                <input type="text" class="form-control" placeholder="200.00" name="price" id="price"
                    value="{{ old('price') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Modelo do equipamento</label>
                <input type="text" class="form-control" placeholder="Acer Apire 2030" name="model" id="model"
                    value="{{ old('model') }}">
            </div>
            <div class="col">
                <label for="">Licença do Windows</label>
                <input type="text" class="form-control" placeholder="DWRE-FDGW-GFGH-KUYU-TREY" name="windows_key"
                    id="windows_key" value="{{ old('windows_key') }}">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="">Descrição do serviço</label>
                <textarea class="form-control" rows="3" name="description" id="description"
                    value="{{ old('description') }}"></textarea>
            </div>
        </div>
        <br>
        <div class="card-footer">
            <a class="btn btn-primary btn-sm" onclick="createOrder()">Adicionar Serviço</a>
            <a class="btn btn-danger btn-sm" onclick="deleteOrder({{ $order_id }})" href="{{ route('service.index') }}">Cancelar OS</a>
            <a href="{{ route('service.index') }}" class="btn btn-success btn-sm">Concluir OS</a>
        </div>
    </form><br>

    <div id="total_service" class="card-footer">
        <div class="col-6">
            <input type="hidden" id="totalService"  value="0">
            
        </div>
    </div>

    <table class="table table-ordered table-hover" id="tblOrders">
        <thead>
            <tr>
                <th>Id Serviço</th>
                <th>Ordem</th>
                <th>Tipo de Serviço</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Total Item</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>

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


@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
    </script>
@endsection
