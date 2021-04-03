//applies masking to the phone input
function foneMask(telefone){ 
    onlyNumbers();
    if(telefone.value.length == 0)
        telefone.value = '(' + telefone.value; 
    if(telefone.value.length == 3)
        telefone.value = telefone.value + ') '; 
    if(telefone.value.length == 10)
        telefone.value = telefone.value + '-';
}

 //Allows you to only use numbers
function onlyNumbers(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }

 //Allows you to only use letters and the space character
 function onlyLetters(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /^[a-z.A-Z. .áãêéíç.ÁÃÊÉÍÇ]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }

 //allows only allowed characters for emails
 function emailValidate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /^[a-z._.0-9.@..]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }

 //applies masking to the cpf input
$("#cpf").keypress(function(){
    onlyNumbers();
    if(cpf.value.length == 3)
        cpf.value = cpf.value + '.'; 
    if(cpf.value.length == 7)
        cpf.value = cpf.value + '.'; 
    if(cpf.value.length == 11)
        cpf.value = cpf.value + '-';                 
});

//applies masking to the cnpj input
$("#cnpj").keypress(function(){
    onlyNumbers();
    if(cnpj.value.length == 2)
        cnpj.value = cnpj.value + '.'; 
    if(cnpj.value.length == 6)
        cnpj.value = cnpj.value + '.'; 
    if(cnpj.value.length == 10)
        cnpj.value = cnpj.value + '/';    
        if(cnpj.value.length == 15)
        cnpj.value = cnpj.value + '-';                    
});

 $("#price").keypress(function(){
    onlyNumbers();                 
}); 
