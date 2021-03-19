<div class="modal fade" id="export_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formExport" action="{{ route('service.export') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="">Tomador de Serviço</label>
                            <select class="form-control" name="filter_client_id" id="filter_client_id">
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
                    <select class="form-control" name="filter_category" id="filter_category">
                        <option selected>Selecione</option>
                        <option>Formatação</option>
                        <option>Formatação e Manutenção Preventiva</option>
                        <option>Concerto</option>
                    </select>

                </div>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Colunas exportáveis</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" onclick="selectAllCheckBox(this.checked);" id="select">
                                <label class="form-check-label" for="">
                                    <span id="acao"><b>Marcar Todos</b></span>
                                </label> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="id" id="f_id" name="f_id">
                                <label class="form-check-label" for="">
                                    Id do serviço
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="client_id" id="f_client_id" name="f_client_id">
                                <label class="form-check-label" for="">
                                    Id do cliente
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="description" id="f_description" name="f_description">
                                <label class="form-check-label" for="">
                                    Decrição
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="order" id="f_order" name="f_order">
                                <label class="form-check-label" for="">
                                    Numero da ordem
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="category" id="f_category" name="f_category">
                                <label class="form-check-label" for="">
                                    Tipo de serviço
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="price" id="f_price" name="f_price">
                                <label class="form-check-label" for="">
                                    Valor
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="model" id="f_model" name="f_model">
                                <label class="form-check-label" for="">
                                    Modelo do equipamento
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="windows_key" id="f_windows_key" name="f_windows_key">
                                <label class="form-check-label" for="">
                                    Licença windows
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="amount" id="f_amount" name="f_amount">
                                <label class="form-check-label" for="">
                                    Quantidade
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFilters()" class="btn btn-danger" >Limpar Filtros</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Exportar</button>
                </div>
            </form>
        </div>
    </div>
</div>
