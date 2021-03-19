<div class="modal" tabindex="-1" role="dialog" id="digService">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="card border">
                <div class="card-body">
                    <form id="formService">
                        @csrf
                        <div class="modal-header">
                            <h4>Editar Ordem</h4>
                        </div>
                            <div class="form-group">

                                <div class="row">
                                <p>Outros serviços da mesma Ordem.</p>
                                    <ul class="nav nav-tabs " id="linkOrders">
                                        
                                    </ul>
                                </div>


                                <br>
                                <input type="hidden" id="id" value="id" class="form-control">
                                <input type="hidden" id="order" value="order" class="form-control">

                                <div class="row">
                                    <div class="col">
                                        <label for="">Tomador de Serviço</label>
                                        <input type="hidden" id="client_id" value="client_id" class="form-control">
                                        <select class="form-control" name="client" id="client" disabled>
                                            <option selected>Selecione</option>
                                            @foreach ($listClients as $item)
                                                <option>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Status do Serviço</label>
                                        <select class="form-control" name="status" id="status">
                                            <option selected>Selecione</option>
                                            <option>Aguardando aprovação</option>
                                            <option>Em andamento</option>
                                            <option>Finalizado</option>
                                            <option>Reprovado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" placeholder="" name="amount" id="amount"
                                            value="{{ old('amount') }}">
                                    </div>
                                    <div class="col">
                                        <label for="">Valor Unitário</label>
                                        <input type="text" class="form-control" placeholder="200.00" name="price" id="price"
                                            value="{{ old('price') }}">
                                    </div>
                                </div>
                                <label for="">Tipo de serviços</label>
                                <select class="form-control" name="category" id="category">
                                    <option selected>Formatação</option>
                                    <option>Formatação e Manutenção Preventiva</option>
                                    <option>Concerto</option>
                                </select>

                                <div class="row">
                                    <div class="col">
                                    <label for="">Modelo do equipamento</label>
                                    <input type="text" class="form-control" placeholder="Acer Apire 2030" name="model"
                                        id="model" value="{{ old('model') }}">
                                    </div>
                                
                                    <div class="col">
                                        <label for="">Licença do Windows</label>
                                        <input type="text" class="form-control" placeholder="DWRE-FDGW-GFGH-KUYU-TREY"
                                            name="windows_key" id="windows_key" value="{{ old('windows_key') }}">
                                    </div>
                                </div>                                   
                                
                                <label for="">Descrição do serviço</label>
                                <textarea class="form-control" rows="3" name="description" id="description"
                                    value="{{ old('description') }}">
                                </textarea>

                                <label for="">Conclusão do Serviço</label>
                                <textarea class="form-control" rows="3" name="description" id="description"
                                    value="{{ old('description') }}">
                                </textarea>
                            </div>
                        <button type="button" onclick="saveEdit();" class="btn btn-primary btn-sm">Salvar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancelar</button>
                    </form>
                </div>      
            </div>
        </div>
    </div>
</div>
