$(document).ready(function(){
    $("#data_cad").val(data_atual());
    $("#cpf").inputmask({"mask": "999.999.999-99"});
    $("#telefone").inputmask({"mask": "(99) 99999-9999"});
    $("#cartao").inputmask({"mask": "9999 9999 9999 9999"});
    $("#venc_cartao").inputmask({"mask": "99/99"});
    $("#cvv").inputmask({"mask": "999"});
});

function form_conta(){
    $("#dados_conta").removeClass("d-none");
    $("#dados_cartao").addClass("d-none");
}

function form_cartao(){
    $("#dados_conta").addClass("d-none");
    $("#dados_cartao").removeClass("d-none");
}

async function grava_dados(){
    body = $("#form_cadastro").serialize();
    console.log(body);
    $("#form_cadastro input,select").attr("disabled", true);

    await $.post("control/cadastro.php", body,function(data){
        retorno = JSON.parse(data);

        if(!retorno['status']){
            alert(retorno['msg']);
            $("#form_cadastro input,select").attr("disabled", false);
        } else {
            alert(retorno['msg']);
            modulo('form_cadastro.html');
        }
    })
}