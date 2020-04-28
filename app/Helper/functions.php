<?php

use Illuminate\Support\Facades\Auth;

function limpaCPF($valor){
    $valor = preg_replace('/[^0-9]/', '', $valor);
    return $valor;
}
function formatCpf($valor)
{
    $cnpj_cpf = preg_replace("/\D/", '', $valor);

    if (strlen($cnpj_cpf) === 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    }

    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

function inicialMaiuscula($string) {
    $string = mb_strtolower(trim(preg_replace("/\s+/", " ", $string)));//transformo em minuscula toda a sentença
    $palavras = explode(" ", $string);//explodo a sentença em um array
    $t =  count($palavras);//conto a quantidade de elementos do array
    for ($i=0; $i <$t; $i++){ //entro em um for limitando pela quantidade de elementos do array
        $retorno[$i] = ucfirst($palavras[$i]);//altero a primeira letra de cada palavra para maiuscula
        if($retorno[$i] == "Dos" || $retorno[$i] == "De" || $retorno[$i] == "Do" || $retorno[$i] == "Da" || $retorno[$i] == "E" || $retorno[$i] == "Das"):
            $retorno[$i] = mb_strtolower($retorno[$i]);//converto em minuscula o elemento do array que contenha preposição de nome próprio
        endif;
    }
    return implode(" ", $retorno);
}

function registraErro($url,$codigo)
{
    app(\App\Http\Controllers\Erros\ErrosController::class)->store($url,$codigo);
}