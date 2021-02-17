@extends('layout.app', ["currentRoute" => "service"])

@section('body')

    <h1>Listagem de serviços</h1>

    <div class="card border">
        <div class="card-footer">
            <a href="{{ route('service.new') }}" class="btn btn-primary btn-sm">Novo Serviço</a>
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter_modal">Filtrar</a>
            <a href="" class="btn btn-primary btn-sm" onclick="listServices()">Limpar filtro</a>
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#export_modal">Exportar</a>
        </div>
        <div class="card-body">
            <h4>Todos os Serviços</h4>
            @if (count($listServices) > 0)

                <table class="table table-ordered table-hover" id="tblServices">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Ordem</th>
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
            @endif
        </div>

    </div>

    <div class="modal fade" id="export_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formExport" action="{{route('service.export')}}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Exportar Listagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="id" name="f_id">
                                    <label class="form-check-label" for="">
                                        Id do serviço
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="client_id" name="f_client_id">
                                    <label class="form-check-label" for="">
                                        Id do cliente
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="description" name="f_description" >
                                    <label class="form-check-label" for="">
                                        Decrição
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="order" name="f_order">
                                    <label class="form-check-label" for="">
                                        Numero da ordem
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="category" name="f_category" >
                                    <label class="form-check-label" for="">
                                        Tipo de serviço
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="price" name="f_price">
                                    <label class="form-check-label" for="">
                                        Valor
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="model" name="f_model" >
                                    <label class="form-check-label" for="">
                                        Modelo do equipamento
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="windows_key" name="f_windows_key">
                                    <label class="form-check-label" for="">
                                        Licença windows
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="amount" name="f_amount" >
                                    <label class="form-check-label" for="">
                                        Quantidade
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Ver Resultados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formfilter">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filtral listagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="">Tomador de Serviço</label>
                                <select class="form-control" name="filter_client" id="filter_client" disabled>
                                    <option selected>Selecione</option>
                                    @foreach ($listClients as $item)
                                        <option>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Numero da Ordem</label>
                                <input type="number" class="form-control" name="filter_order" id="filter_order">
                            </div>
                        </div>
                        <label for="">Tipo de serviços</label>
                        <select class="form-control" name="filter_category" id="filter_category" disabled>
                            <option selected>Formatação</option>
                            <option>Formatação e Manutenção Preventiva</option>
                            <option>Concerto</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Ver Resultados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('component.serviceEditModal')

@endsection


@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(function() {
            listServices();
        });

        $("#formService").submit(function(event) {
            event.preventDefault();
            if ($("#id").val() != '') {
                saveEdit();
            }
            $("#digService").modal('hide');
        });

        $("#formfilter").submit(function(event) {
            event.preventDefault();
            filter();
            $("#filter_modal").modal('hide');
        });

/*          $("#formExport").submit(function(event) {
            event.preventDefault();
            $("#export_modal").modal('hide');
        }); */

    </script>
@endsection
