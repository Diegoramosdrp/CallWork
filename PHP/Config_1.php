<?php

function newConection() {
    return $conecao = new PDO('mysql:host=localhost; dbname=callwork', 'root', '');
}

?>