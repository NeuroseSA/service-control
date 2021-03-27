//limpa modal de filtros de exporta. #export_modal
function clearFilters() {

    $('#filter_client_id').val('Selecione');
    $('#filter_category').val('Selecione');
    $('#filter_order').val('');
    selectAllCheckBox();
    document.getElementById('select').checked = false;
}

//marca ou desmaca todos os checkbox 
function selectAllCheckBox(marcar) {

    if (marcar) {
        document.getElementById('acao').innerHTML = '<b>Desmarcar Todos</b>';
        document.getElementById('f_id').checked = true;
        document.getElementById('f_client_id').checked = true;
        document.getElementById('f_category').checked = true;
        document.getElementById('f_description').checked = true;
        document.getElementById('f_model').checked = true;
        document.getElementById('f_windows_key').checked = true;
        document.getElementById('f_price').checked = true;
        document.getElementById('f_amount').checked = true;
        document.getElementById('f_order').checked = true;
    } else {
        document.getElementById('acao').innerHTML = '<b>Marcar Todos</b>';
        document.getElementById('f_id').checked = false;
        document.getElementById('f_client_id').checked = false;
        document.getElementById('f_category').checked = false;
        document.getElementById('f_description').checked = false;
        document.getElementById('f_model').checked = false;
        document.getElementById('f_windows_key').checked = false;
        document.getElementById('f_price').checked = false;
        document.getElementById('f_amount').checked = false;
        document.getElementById('f_order').checked = false;
    }
}

//Captura eventos do modal a limpa os campos.
$(document).ready(function () {

    $('.modal').on('hidden.bs.modal', function () {
        clearFilters();
        $('#option_delete>a').remove();
    });

    $('#filter_modal').on('show.bs.modal', function () {
        //Limpar modal de filtros. #filter_modal
        $('#list_filter_client').val('Selecione');
        $('#list_filter_order').val('');
        $('#list_filter_category').val('Selecione');
    });


});

//Aciona o metodo listFilter no ServiceController passando objeto com os filtros estabelecidos e o page na requisição
function listFilter(page) {

    filteredListing = {
        order: $("#list_filter_order").val(),
        client: $("#list_filter_client").val(),
        category: $("#list_filter_category").val()
    };
    $.ajax({
        type: "GET",
        url: "/servico/filtros?page=" + page,
        context: this,
        data: filteredListing,
        success: function (orders) {
            $('#tblServices>tbody>').remove();
            for (i = 0; i < orders.data.length; i++) {
                line = showLine(orders.data[i]);
                $('#tblServices>tbody').append(line);
            }
            showPaginator(orders);
            $("#paginatorService>ul>li>a").click(function () {
                listFilter($(this).attr('page'));
            });
        },
        error: function (error) {
            console.log(error);
        }
    });

}

//Carrega listagem de serviços paginada, é acionada quando a página carrega ou temos acionamento do #clearFilters
function listServices(page) {
    id = $("#iduser").val();
    $.getJSON('/api/servico/' + id, { page: page }, function (orders) {
        $('#tblServices>tbody>').remove();
        for (i = 0; i < orders.data.length; i++) {
            line = showLine(orders.data[i]);
            $('#tblServices>tbody').append(line);
        }
        showPaginator(orders);
        $("#paginatorService>ul>li>a").click(function () {
            listServices($(this).attr('page'));
        });
    });
}

//Monta linha a linha da listagem
function showLine(os) {

    var line =
        "<tr>"
        +
        "<td>" + os.id + "</td>" +
        "<td>" + os.order + "</td>" +
        "<td>" + os.client_id + "</td>" +
        "<td>" + os.category + "</td>" +
        "<td>" + os.price + "</td>" +
        "<td>" + os.model + "</td>" +
        "<td>" + os.windows_key + "</td>" +
        "<td>" + os.description + "</td>" +
        "<td>" + os.price * os.amount + "</td>" +
        "<td>" + '<a class="btn btn-sm btn-primary" onclick="editService(' + os.id + ')" style="width: 70px">Editar </a>' +
        '<a class="btn btn-sm btn-danger" onclick="confirmDelete(' + os.id + ',' + os.order + ')"style="width: 70px">Apagar </a>' +
        "</td>"
        +
        "</tr>";

    return line;
}

//Captura a pagina atual para retornar no acionamento de anterior da paginação
function getItemPrevious(orders) {
    i = orders.current_page - 1;
    if (1 == orders.current_page) {
        page = '<li class="page-item disabled">';
    } else {
        page = '<li class="page-item active">';
    }
    page += '<a class="page-link" page="' + i + '" href="">Anterior</a></li>';
    return page;
}

//Captura a pagina atual para avançar para proxima pagina na paginação
function getItemNext(orders) {
    i = orders.current_page + 1;
    if (orders.last_page == orders.current_page) {
        page = '<li class="page-item disabled">';
    } else {
        page = '<li class="page-item active">';
    }
    page += '<a class="page-link" page="' + i + '" href="">Próximo</a></li>';
    return page;
}

//Monta a paginação destacando a pagina atual
function getItem(orders, i) {
    if (i == orders.current_page) {
        page = '<li class="page-item active">';
    } else {
        page = '<li class="page-item">';
    }
    page += '<a class="page-link" page="' + i + '" href="">' + i + '</a></li>';
    return page;
}

//Valida a quantidade de ites que a contagem de paginação apresentará.
function showPaginator(orders) {

    $("#paginatorService>ul>").remove();
    $("#paginatorService>ul").append(getItemPrevious(orders));

    if ((orders.current_page - 4) >= 1) {

        if ((orders.last_page - orders.current_page) >= 5) {
            start = orders.current_page - 4;
            end = orders.current_page + 5;
        } else {
            end = orders.last_page;
            if ((orders.last_page - 9) <= 0) {
                start = 1;
            } else {
                start = orders.last_page - 9;
            }
        }
    } else {
        start = 1;
        if ((orders.last_page - orders.current_page) >= 10) {
            end = 10;
        } else {
            end = orders.last_page;

        }
    }

    for (i = start; i <= end; i++) {
        getItem(orders, i);
        $("#paginatorService>ul").append(page);
    }
    $("#paginatorService>ul").append(getItemNext(orders));

}

//Salva edições do serviço realizada no modal e atualiza a listagem
function saveEdit() {
    serv = {
        id: $("#id").val(),
        status: $("#status").val(),
        category: $("#category").val(),
        price: $("#price").val(),
        amount: $("#amount").val(),
        order: $("#order").val(),
        model: $("#model").val(),
        windows_key: $("#windows_key").val(),
        description: $("#description").val(),
        client_id: $("#client_id").val()
    };
    $.ajax({
        type: "PUT",
        url: "/api/servico/" + serv.id,
        context: this,
        data: serv,
        success: function (data) {
            serv = JSON.parse(data);
            console.log("Editado com sucesso!");
            lines = $("#tblServices>tbody>tr");
            item = lines.filter(function (i, elemento) {
                return (elemento.cells[0].textContent == serv.id);
            });
            if (item) {
                item[0].cells[0].textContent = serv.id;
                item[0].cells[1].textContent = serv.order;
                item[0].cells[2].textContent = serv.client_id;
                item[0].cells[3].textContent = serv.category;
                item[0].cells[4].textContent = serv.price;
                item[0].cells[5].textContent = serv.model;
                item[0].cells[6].textContent = serv.windows_key;
                item[0].cells[7].textContent = serv.description;
                item[0].cells[8].textContent = serv.price * serv.amount;
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//mostrar todos os serviços da mesma ordem no modal em uma paginação
function paginatorServiceModal(i, currentOrder) {
    if (i == currentOrder) {
        $('#linkOrders').append('<li class="nav-item"> <a class="nav-link active " onclick="editService(' + i + ');"><b>Serviço #' + i + '</b></a></li>');
    } else {
        $('#linkOrders').append('<li class="nav-item"> <a class="nav-link" onclick="editService(' + i + ');"><b>Serviço #' + i + '</b></a></li>');
    }
}

//Preenche as informações do modal quando a edição do serviço é acionada
function editService(id) {

    $('#digService').modal('show');

    $.getJSON("/api/servico/editar/" + id, function (orders) {
        $('#linkOrders>').remove();
        for (i = 0; i < orders.length; i++) {
            paginatorServiceModal(orders[i].id, id);
            if (orders[i].id == id) {

                getNameClient(orders[i].client_id);
                $("#id").val(orders[i].id);
                $("#status").val(orders[i].status);
                $("#client_id").val(orders[i].client_id);
                $("#category").val(orders[i].category);
                $("#model").val(orders[i].model);
                $("#order").val(orders[i].order);
                $("#price").val(orders[i].price);
                $("#amount").val(orders[i].amount);
                $("#description").val(orders[i].description);
                $("#windows_key").val(orders[i].windows_key);
            }
        }
    });
}

//deleta o serviço e atualiza a listagem
function Service_deleteService(id) {
    $.ajax({
        type: "DELETE",
        url: "/api/servico/" + id,
        context: this,
        success: function () {
            console.log("Removido com sucesso!");
            lines = $("#tblServices>tbody>tr");
            item = lines.filter(function (i, elemento) {
                return elemento.cells[0].textContent == id;
            });
            if (item) {
                item.remove();
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//Catura o nome do cliente pelo ID da listagem
function getNameClient(getName) {

    $.getJSON("/api/cliente/" + getName, function (data) {

        return $("#client").val(data.name);

    });

}

//Confirmar se apaga somente o serviço ou toda OS
function confirmDelete(service_id, order_id) {
    $("#confirm_delete").modal('show');

    optionDelete =
        '<a class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>' +
        '<a class="btn btn-primary btn-sm" onclick="Service_deleteService(' + service_id + ')" data-dismiss="modal">Apagar Serviço</a>' +
        '<a class="btn btn-danger btn-sm" onclick="deleteOrder(' + order_id + ')" data-dismiss="modal">Apagar OS</a>'
        ;

    $('#option_delete').append(optionDelete);

}

