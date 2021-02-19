@extends('layout.app', ["currentRoute" => "service"])

@section('body')

    <h1>Listagem de serviços</h1>

    <div class="card border">
        <div class="card-footer">
            <a href="{{ route('service.new') }}" class="btn btn-primary btn-sm">Novo Serviço</a>
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter_modal">Filtrar</a>
            <button type="" onclick="listServices();" id="listService" class="btn btn-primary btn-sm">Limpar filtro</button>
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

    @include('component.serviceExportModal')

    <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formfilter">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filtrar listagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="">Tomador de Serviço</label>
                                <select class="form-control" id="list_filter_client">
                                    <option selected>Selecione</option>
                                    @foreach ($listClients as $item)
                                        <option>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Numero da Ordem</label>
                                <input type="number" class="form-control" id="list_filter_order">
                            </div>
                        </div>
                        <label for="">Tipo de serviços</label>
                        <select class="form-control" id="list_filter_category">
                            <option selected>Selecione</option>
                            <option>Formatação</option>
                            <option>Formatação e Manutenção Preventiva</option>
                            <option>Concerto</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
            listFilter();
            $("#filter_modal").modal('hide');
        }); 
    </script>
@endsection
