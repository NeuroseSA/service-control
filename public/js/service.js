function clearFilters() {
    $('#filter_client_id').val('Selecione');
    $('#filter_category').val('Selecione');
    $('#filter_order').val('');
    selectAll();
    document.getElementById('select').checked = false;
}

function selectAll(marcar) {
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

$(document).ready(function () {
    $('.modal').on('hidden.bs.modal', function () {
        console.log('fechar modal')
        clearFilters();
    });
});

function listFilter() {

    filteredListing = {
        order: $("#list_filter_order").val(),
        client: $("#list_filter_client").val(),
        category: $("#list_filter_category").val()
    };
    console.log(filteredListing);
    $.ajax({
        type: "POST",
        url: "/api/servico/filtros/",
        context: this,
        data: filteredListing,
        success: function (os) {
            orders = JSON.parse(os);
            $('#tblServices>tbody>').remove();
            console.log(orders);
             for (i = 0; i < orders.length; i++) {
                line = showLine(orders[i]);
                $('#tblServices>tbody').append(line);
            } 
        },
        error: function (error) {        
            console.log(error);
        }
    });
    
}

function listServices() {
    $.getJSON('/api/servico', function (orders) {
        for (i = 0; i < orders.length; i++) {
            line = showLine(orders[i]);
            $('#tblServices>tbody').append(line);
        }
    });
}

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
        "<td>" + '<a class="btn btn-sm btn-primary" onclick="editService(' + os.id + ')">Editar </a>' +
        '<a class="btn btn-sm btn-danger" onclick="deleteService(' + os.id + ')">Apagar </a>' +
        "</td>"
        +
        "</tr>";

    return line;
}

function saveEdit() {
    serv = {
        id: $("#id").val(),
        category: $("#category").val(),
        price: $("#price").val(),
        amount: $("#amount").val(),
        order: $("#order").val(),
        model: $("#model").val(),
        windows_key: $("#windows_key").val(),
        description: $("#description").val(),
        client_id: $("#client_id").val()
    };
    console.log(serv);
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
                item[0].cells[1].textContent = serv.id;
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

function createOrder() {
    order = {
        order: $("#order").val(),
        client: $("#client").val(),
        category: $("#category").val(),
        model: $("#model").val(),
        price: $("#price").val(),
        amount: $("#amount").val(),
        description: $("#description").val(),
        windows_key: $("#windows_key").val()
    };
    console.log(order);
    $.post('/api/servico', order, function (data) {
        os = JSON.parse(data);
        line = showLine(os);
        $('#tblServices>tbody').append(line);
    });
}

function editService(id) {
    console.log(id);

    $.getJSON("/api/servico/" + id, function (data) {
        getNameClient(data.client_id);
        console.log(data);

        $("#id").val(data.id);
        $("#client_id").val(data.client_id);
        $("#category").val(data.category);
        $("#model").val(data.model);
        $("#order").val(data.order);
        $("#price").val(data.price);
        $("#amount").val(data.amount);
        $("#description").val(data.description);
        $("#windows_key").val(data.windows_key);
        $('#digService').modal('show');
    });
}

function deleteService(id) {
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

function getNameClient(getName) {
    $.getJSON("/api/cliente/" + getName, function (data) {


        console.log(data.name);
        return $("#client").val(data.name);

    });
}