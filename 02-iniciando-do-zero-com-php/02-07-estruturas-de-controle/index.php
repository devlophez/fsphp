<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.07 - Estruturas de controle");

/*
 * [ if ] https://php.net/manual/pt_BR/control-structures.if.php
 * [ elseif ] https://php.net/manual/pt_BR/control-structures.elseif.php
 * [ else ] https://php.net/manual/pt_BR/control-structures.else.php
 */
fullStackPHPClassSession("if, elseif, else", __LINE__);

$test = false;

if ($test) {
    var_dump(true);
} else {
    var_dump(false);
}

$age = 23;

if ($age < 20) {
    var_dump("Bandas Coloridas");
} else if ($age > 20 && $age < 50) {
    var_dump("Ótimas Bandas");
} else {
    var_dump("Rock and Roll Raiz");
}

$hour = 23;

if ($hour >= 5 && $hour < 23) {
    if ($hour < 7) {
        var_dump("Bob Marley");
    } else {
        var_dump("After Bridge");
    }
} else {
    var_dump("ZZZzzzzzZZZZ");
}


/*
 * [ isset ] https://php.net/manual/pt_BR/function.isset.php
 * [ empty] https://php.net/manual/pt_BR/function.empty.php
 */
fullStackPHPClassSession("isset, empty, !", __LINE__);

//verifica se a variável existe

$rock = "";
if (isset($rock)) {
    var_dump("Rock and Roll!!!");
} else {
    var_dump("Die!");
}

//verifica se a variável não existe ou se não tem conteúdo

$rockAndRoll = "AC/DC";

if (!empty($rockAndRoll)) {
    var_dump("Rock existe e toca {$rockAndRoll}!");
} else {
    var_dump("Rock não existe ou não está tocando.");
}

/*
 * [ switch ] https://secure.php.net/manual/pt_BR/control-structures.switch.php
 */
fullStackPHPClassSession("switch", __LINE__);

$payment = "canceled";
switch ($payment) {
    case 'billet_printed':
        var_dump("Boleto impresso");
        break;
    case 'canceled':
        var_dump("Pagamento cancelado");
        break;
    case 'past_due':
    case 'pending':
        var_dump("Aguardamento aprovado");
        break;
    case 'approved':
    case 'completed':
        var_dump("Pagamento Aprovado");
        break;
    default:
        var_dump("Erro ao processar pagamento");
        break;
}




