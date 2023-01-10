$(document).ready(function(){
    $("#data_cad").val(data_atual());
    $("#cpf").inputmask({"mask": "999.999.999-99"});
    $("#telefone").inputmask({"mask": "(99) 99999-9999"});
});