<?php

function getClients() {

    $cliente1 = array(
        "name" => "Edu",
        "lastname"  => "Gutierrez",
        "age"  => 16,
        "developer" => true
    );

    $cliente2 = array(
        "name" => "Mou",
        "lastname"  => "Jemmahri",
        "age"  => 26,
        "developer" => false
    );

    $cliente3 = array(
        "name" => "Katakuri",
        "lastname"  => "Charlotte",
        "age"  => 28,
        "developer" => false
    );

    return array($cliente1, $cliente2, $cliente3);
}

?>