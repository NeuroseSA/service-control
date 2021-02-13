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
            <a class="btn btn-primary btn-sm" onclick="createOrder()">Adicionar</a>
            <a class="bbtn btn-danger btn-sm" onclick="saveOrder()">Finalizar</a>
        </div>
        {{-- <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
        <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
        <button type="submit" class="btn btn-primary btn-sm">Finalizar</button>
        <button type="submit" onclick="" class="btn btn-danger btn-sm">Cancelar</button> --}}
    </form><br>

    <div class="card-footer">
        <div class="col-6">
            <input type="hidden" id="totalService" name="totalService" value="0">
            <h4 id="total"></h4>
        </div>
    </div>

    <table class="table table-ordered table-hover" id="tblServices">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Tipo de Serviço</th>
                <th>Valor</th>
                <th>Modelo</th>
                <th>Licença</th>
                <th>Descrição</th>
                <th>Total Item</th>
                <th>Ações</th>
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

    @include('component.serviceEditModal')

@endsection


@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $("#formService").submit(function (event) {
            event.preventDefault();
            if($("#id").val() != ''){
                saveEdit();
            }           
            $("#digService").modal('hide');           
        });






        /*         function showLine(os) {     
                    total = parseInt($('#totalService').val());       
                    var line = 
                    "<tr>" 
                        +
                            "<td>" + os.order + "</td>" +
                            "<td>" + os.category + "</td>" +
                            "<td>" + os.amount + "</td>" +
                            "<td>" + os.price + "</td>" +
                            "<td>" + os.model + "</td>" +
                            "<td>" + os.description + "</td>" +
                            "<td>" + os.windows_key + "</td>" +
                            "<td>" + os.price * os.amount + "</td>"
        /*                     "<td>" + '<a class="btn btn-sm btn-primary" onclick="editOrder('+ os.id +')">Editar </a>' +
                                    '<a class="btn btn-sm btn-danger" onclick="deleteOrder('+ os.id +')">Apagar </a>' +
                            "</td>"  
                        +
                    "</tr>";   
                    
                    total = total + (os.price * os.amount);
                    $('#totalService').val(total);
                    $('#total').html("Valor total do serviço: R$ " + total);
                    return line;      
                } */

    </script>
@endsection
