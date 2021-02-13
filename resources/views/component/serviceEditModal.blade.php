<div class="modal" tabindex="-1" role="dialog" id="digService">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card border">
                <div class="card-body">
                    <form id="formService">
                        @csrf
                        <div class="modal-header">
                            <h4>Editar Serviço</h4>
                        </div>
                        <div class="form-group">
                            <br>
                            <input type="hidden" id="id" value="id" class="form-control">
                            <input type="hidden" id="order" value="order" class="form-control">
                            <label for="">Tomador de Serviço</label>
                            <input type="hidden" id="client_id" value="client_id" class="form-control">
                            <select class="form-control" name="client" id="client" disabled>
                                <option selected >Selecione</option>
                                @foreach ($listClients as $item)
                                    <option>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="row">
                                <div class="col">
                                    <label for="">Quantidade</label>
                                    <input type="number" class="form-control" placeholder="" name="amount" id="amount" value="{{ old('amount') }}">
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

                            <label for="">Modelo do equipamento</label>
                            <input type="text" class="form-control" placeholder="Acer Apire 2030" name="model"
                                id="model" value="{{ old('model') }}">
                            <label for="">Licença do Windows</label>
                            <input type="text" class="form-control" placeholder="DWRE-FDGW-GFGH-KUYU-TREY"
                                name="windows_key" id="windows_key" value="{{ old('windows_key') }}">
                            <label for="">Descrição do serviço</label>
                            <textarea class="form-control" rows="3" name="description" id="description" value="{{ old('description') }}"></textarea>



                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Cancelar</button>
                    </form>
                </div>
                @if ($errors->any())
                    <div class="card-footer">
                        @foreach ($errors->all() as $errors)
                            <div class="alert alert-danger" role="alert">
                                {{ $errors }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
