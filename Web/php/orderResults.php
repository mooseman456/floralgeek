<?php
    include "API.php";
    session_start();
    
    $root = $_POST['root'];
    $table = $_POST['table'];
    $sort = $_POST['sort'];

    echo orderResults($root, $table, $sort);
?>