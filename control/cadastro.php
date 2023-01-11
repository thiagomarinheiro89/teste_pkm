<?php
    require('config.php');

    if(isset($_POST) && !empty($_POST)){
        valida_campos($_POST);
        valida_cpf($_POST['cpf']);
        valida_email($_POST['email']);
        valida_idade($_POST['data_nasc']);
        valida_dados_pagamento($_POST['forma_pag']);
        grava_banco($_POST);
    } else {
        lista_doadores();
    }

    function valida_campos($campos){
        $campos = array("nome","email","cpf","telefone","data_nasc","data_cad","intervalo","valor","forma_pag","cep","endereco","numero","bairro","cidade","estado");

        foreach ($campos as $campo) {
            if (!isset($_POST[$campo]) || $_POST[$campo]=='') {
                retorno(false, "Por favor preencha todos os campos do formulário", $campo);
            }
        }

    }


    function retorno($status, $mensagem, $dados = array()){
        $retorno = array('status' => $status, 'msg' => $mensagem, 'dados' => $dados);
        echo json_encode($retorno);
        die();
    }

    function valida_cpf($cpf){
            // Extrai somente os números
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
            
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11) {
                return false;
            }

            // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }

            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    retorno(false, "CPF Inválido", "cpf");
                }
            }

            verifica_base('cpf', $_POST['cpf']);
            return true;
    }

    function valida_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          retorno(false, "Email Inválido", "email");
        }

        verifica_base('email', $email);

        return true;
    }

    function valida_idade($data){
        $idade = 0;
        $data_nascimento = date('Y-m-d', strtotime($data));
        $data = explode("-",$data_nascimento);
        $anoNasc    = $data[0];
        $mesNasc    = $data[1];
        $diaNasc    = $data[2];
    
        $anoAtual   = date("Y");
        $mesAtual   = date("m");
        $diaAtual   = date("d");
    
        $idade      = $anoAtual - $anoNasc;
        if ($mesAtual < $mesNasc){
            $idade -= 1;
        } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
            $idade -= 1;
        }
        
        if ($idade < 18) {
            retorno(false, "Você precisa ter pelo menos 18 anos para doar", 'data_nasc');
        }
        
        return true;
    }

    function valida_dados_pagamento($tipo){
        switch ($tipo) {
            case 'debito':
                $campos = array("cod_banco", "agencia", "conta");                
            break;
            
            default:
                $campos = array("cartao", "nome_ipresso", "venc_cartao","cvv"); 
            break;
        }

        foreach ($campos as $campo) {
            if (!isset($_POST[$campo]) || $_POST[$campo]=='') {
                retorno(false, "Por favor preencha os dados de pagamento", $campo);
            }
        }

        valida_cartao($tipo, $_POST['cartao']);
    }

    function valida_cartao($tipo, $cartao){
        if($tipo != 'debito'){
            $cartao = str_replace("_",'', $cartao);

            if(strlen($cartao < 12)){
             retorno(false, "Formato de cartão inválido", "cartao");
            } else {
                verifica_base('cartao', $_POST['cartao']);
            }

        }

        return true;
    }

    function verifica_base($campo, $valor){
        $sql = "SELECT COUNT(*) as qtd FROM doadores where " . $campo ." = ?";
        
        $dados = get_dados($sql, $valor);
        
        if($dados[0]['qtd'] > 0){
            retorno(false, "Já existe um usuário com o " . $campo . " cadastrado ");
        }
    }

    function grava_banco($dados){
        $valores = array(
                         $dados['nome'],
                         $dados['email'],
                         $dados['cpf'],
                         $dados['telefone'],
                         $dados['data_nasc'],
                         $dados['data_cad'],
                         $dados['intervalo'],
                         $dados['valor'],
                         $dados['forma_pag'],
                         $dados['cod_banco'],
                         $dados['agencia'],
                         $dados['conta'],
                         $dados['cartao'],
                         $dados['nome_ipresso'],
                         $dados['venc_cartao'],
                         $dados['cvv'],
                         $dados['cep'],
                         $dados['endereco'],
                         $dados['numero'],
                         $dados['complemento'],
                         $dados['bairro'],
                         $dados['cidade'],
                         $dados['estado']
                        );
        $sql = "INSERT INTO doadores (
                                        nome,
                                        email,
                                        cpf,
                                        telefone,
                                        data_nasc,
                                        data_cad,
                                        intervalo,
                                        valor,
                                        forma_pag,
                                        cod_banco,
                                        agencia,
                                        conta,
                                        cartao,
                                        nome_ipresso,
                                        venc_cartao,
                                        cvv,
                                        cep,
                                        endereco,
                                        numero,
                                        complemento,
                                        bairro,
                                        cidade,
                                        estado
                                    ) values (
                                        ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
                                    )";
        $status = roda_query($sql, $valores);

        //var_dump($status);

        if($status['status']){
            retorno(true, "Doador(a) Cadastrado com sucesso!");
        } else {
            retorno(false, "Não foi possível cadastrar o doador, por favor tente novamente se o erro persistir entre em contato com a administração do sistema!");
        }

    }

    function lista_doadores(){
        $sql = "SELECT d.nome, d.email, d.valor, d.intervalo, d.forma_pag  FROM doadores AS d";
        $dados = get_dados($sql, array());

        retorno(true, "ok", $dados);
    }
?>