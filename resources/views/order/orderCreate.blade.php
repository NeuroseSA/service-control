@extends('layout.app', ["currentRoute" => "order"])

@section('body')

    <h2>Nova ordem de serviço</h2>

    <form id="formOrder">
        @csrf
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
                <label for="">CNPJ</label>
                <input type="text" disabled class="form-control" placeholder="" name="cnpj" id="cnpj" value="">
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
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" id="description"
                    value="{{ old('description') }}"></textarea>
            </div>
        </div>
        <br>
        <div class="card-footer">
            <a class="btn btn-secondary btn-sm" onclick="createOrder()">Adicionar</a>
            <a class="btn btn-secondary btn-sm" onclick="saveOrder()">Finalizar</a>           
        </div>
{{--         <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
        <button type="submit" class="btn btn-primary btn-sm">Finalizar</button>
        <button type="submit" onclick="" class="btn btn-danger btn-sm">Cancelar</button> --}}
    </form><br>

    <table class="table table-ordered table-hover" id="tblOrders">
        <thead>
            <tr>
                <th>Tipo de Serviço</th>
                <th>Valor</th>
                <th>Modelo</th>
                <th>Descrição</th>
                <th>Licença</th>
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

        $(function() {
            listOrders();
            //listCategories();
        });

/*         $("#formOrder").submit(function(event) {
            event.preventDefault();
            createOrder();
        }); */

        function listOrders() {
/*             $.getJSON('/api/servico', function (orders) {
                for ( i = 0; i < orders.length; i++) {
                    line = showLine(orders[i]);
                    $('#tblOrders>tbody').append(line);
                }
            }) */
            $('#tblOrders>tbody').append(line);
        }

        function createOrder() {
            order = {
                client: $("#client").val(),
                category: $("#category").val(),
                model: $("#model").val(),
                price: $("#price").val(),
                description: $("#description").val(),
                windows_key: $("#windows_key").val()
            };
/*             line = showLine(order);
            $('#tblOrders>tbody').append(line); */
            $.post('/api/order', order, function(data) {
                os = JSON.parse(data);
                line = showLine(os);
                $('#tblOrders>tbody').append(line);
            });
        }

        function showLine(os) {
            var line = 
            "<tr>" 
                +
                    "<td>" + os.category + "</td>" +
                    "<td>" + os.price + "</td>" +
                    "<td>" + os.model + "</td>" +
                    "<td>" + os.description + "</td>" +
                    "<td>" + os.windows_key + "</td>"
/*                     "<td>" + '<a class="btn btn-sm btn-primary" onclick="editOrder('+ os.id +')">Editar </a>' +
                            '<a class="btn btn-sm btn-danger" onclick="deleteOrder('+ os.id +')">Apagar </a>' +
                    "</td>"  */
                +
            "</tr>";            
            return line;      
        }

    </script>
@endsection
