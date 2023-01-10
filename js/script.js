function modulo(arquivo){
    pasta = "modulos/"
    $("#conteudo").load(pasta + arquivo);
    
}

function data_atual(){
    dia = new Date();
    ano = dia.getFullYear();
    mes = (dia.getMonth() + 1)<10 ? "0"+(dia.getMonth() + 1):(dia.getMonth() + 1);
    dia = (dia.getDate())<10?"0"+(dia.getDate()):(dia.getDate());
    data = ano+"-"+mes+"-"+dia;
    return data;
}

async function busca_cep(){
    cep = $("#cep").val();
    
    if(cep.length != 8){
        alert("CEP Inválido");
    } else {
        url = "https://viacep.com.br/ws/" + cep + "/json/";

        await $.get(url, function(data){
            $("#endereco").val(data['logradouro']);            
            $("#bairro").val(data['bairro']);            
            $("#cidade").val(data['localidade']);            
            $("#estado").val(data['uf']);

            $("#numero").focus();
        });        
    }
}