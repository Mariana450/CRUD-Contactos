<?php

require_once 'modelo/agenda.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (Agenda::eliminarPorID($id)) {
        echo 'ok';  
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
