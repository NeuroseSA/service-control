//Cria novas ordens
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
            total  = parseInt($("#totalService").val()) + (os.amount * os.price);
            $("#totalService").val(total);
            $('#total_service>div>h5').remove();
            $('#total_service>div').append("<h5>Valor total da OS: R$ " + total +"</h5>");
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//Apaga o serviço inseriro na Ordem(OS)
function Order_deleteService(id) {
    $.ajax({
        type: "DELETE",
        url: "/api/servico/" + id,
        context: this,
        success: function () {
            console.log("Removido com sucesso!");
            lines = $("#tblOrders>tbody>tr");
            item = lines.filter(function (i, elemento) {
                return elemento.cells[0].textContent == id;
            });
            if (item) {
                item.remove();
            }

            total  = parseInt($("#totalService").val()) - (os.amount * os.price);
            $("#totalService").val(total);
            $('#total_service>div>h5').remove();
            $('#total_service>div').append("<h5>Valor total da OS: R$ " + total +"</h5>");
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//Cancela a Ordem de serviço
function deleteOrder(order) {

    $.ajax({
        type: "DELETE",
        url: "/api/servico/ordem/" + order,
        context: this,
        success: function (data) {
            console.log(data);
            console.log("OS cancelada com sucesso!");
        },
        error: function (error) {
            console.log(error);
        }
    });
    listServices();
}

//Monta a linha de cada ordem adicionada.
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
        '<td><a class="btn btn-sm btn-danger" onclick="Order_deleteService(' + os.id + ')">Remover</a>' +
        "</td>"
        +
        "</tr>";

    return line;
} 