<?php
    include "API.php";
    session_start();

    $root = $_POST['root'];
    $start = $_POST['start'];

    if (isset($_POST['orderBy']))
        $orderBy = $_POST['orderBy'];
    else
        $orderBy = "";

    echo changePage($root, $start, $orderBy);

?>