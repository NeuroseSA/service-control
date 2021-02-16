@extends('layout.app', ["currentRoute" => "service"])

@section('body')

<h1>Listagem de serviços</h1>

<div class="card border">
    <div class="card-footer">
        <a href="{{ route('service.new') }}" class="btn btn-primary btn-sm">Novo Serviço</a>
        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalExemplo">Filtrar</a>
        <a href="" class="btn btn-primary btn-sm" onclick="listServices()">Limpar filtro</a>
        <a href="{{ route('service.export') }}" class="btn btn-primary btn-sm">Exportar</a>
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

<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <option >{{ $item->name }}</option>
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
          <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Fechar</button>
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

        $("#formService").submit(function (event) {
            event.preventDefault();
            if($("#id").val() != ''){
                saveEdit();
            }           
            $("#digService").modal('hide');           
        });

        $("#formfilter").submit(function (event) {
            event.preventDefault();
            filter();
            $("#modalExemplo").modal('hide');           
        });

    </script>
@endsection
