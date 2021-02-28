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
    $.ajax({
        type: "POST",
        url: "/api/servico",
        context: this,
        data: order,
        success: function (data) {
            console.log("Cadastrado com sucesso!");
            os = JSON.parse(data);
            line = showLineOrder(os);
            $('#tblOrders>tbody').append(line);
            $("#client").prop("disabled", true);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteOrder(id) {

    $.ajax({
        type: "DELETE",
        url: "/api/servico/" + id,
        context: this,
        success: function () {
            console.log("Removido com sucesso!");
            lines = $("#tblOrders>tbody>tr");
            item = lines.filter(function (i, elemento) {
                var count
                for (let index = 0; index < elemento.cells[index].length; index++) {
                    count = index;               
                }
                if(count < 1){
        $("#client").prop("disabled", false);
                }
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



function listOrders() {

    $('#tblOrders>tbody>').remove();
    $.getJSON('/api/servico', function (orders) {
        for (i = 0; i < orders.length; i++) {
            line = showLineOrder(orders[i]);
            $('#tblOrders>tbody').append(line);
        }
    });
}

function showLineOrder(os) {

    var line =
        "<tr>"
        +
        "<td>" + os.id + "</td>" +
        "<td>" + os.order + "</td>" +
        "<td>" + os.category + "</td>" +
        "<td>" + os.amount + "</td>" +
        "<td>" + os.price + "</td>" +
        "<td>" + os.price * os.amount + "</td>" +
        '<td><a class="btn btn-sm btn-danger" onclick="deleteOrder(' + os.id + ')">Apagar</a>' +
        "</td>"
        +
        "</tr>";

    return line;
}