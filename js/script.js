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

function tabela(tabela){
    $('#'+tabela).DataTable({
                              retrieve: true,
                              paging: false,
                              "bPaginate": true,
                              "language": {
                                          "lengthMenu": 'Mostrar <select>'+
                                                                    '<option value="10">10</option>'+
                                                                    '<option value="20">20</option>'+
                                                                    '<option value="30">30</option>'+
                                                                    '<option value="40">40</option>'+
                                                                    '<option value="50">50</option>'+
                                                                    '<option value="-1">Todos</option>'+
                                                                  '</select>',
                                            "search": "Filtrar _INPUT_ ",
                                            "info": "Mostrando _START_ a _END_ de _TOTAL_" ,
                                            "tabela_previous":"Anterior",
                                            "paginate":{
                                                        "next":"Próximo",
                                                        "previous":"Anterior",
                                                        "last":"Última",
                                                        "first":"Primeira"
                                                       }
                                        }
                              });  
  }