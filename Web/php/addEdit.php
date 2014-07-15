<?php
    include "API.php";
    session_start();

    $values = [
        'businessName' => $_POST['businessName'],
        'businessType' => $_POST['businessType'],
        'addressOne' => $_POST['addressOne'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'zip' => $_POST['zip'],
        'addressTwo' => $_POST['addressTwo'],
        'numLocations' => $_POST['numLocations'],
        'numRooms' => $_POST['numRooms'],
        'rate' => $_POST['rate'],
        'GDS' => $_POST['GDS'],
        'mngtCo' => $_POST['mngtCo'],
        'contactPerson' => $_POST['contactPerson'],
        'personPhone' => $_POST['personPhone'],
        'personEmail' => $_POST['personEmail'],
        'followUp' => $_POST['followUp'],
        'interestLvl' => $_POST['interestLvl'],
        'SPAssigned' => $_POST['SPAssigned'],
        'contactID' => $_POST['contactID'],
    ];

    echo addEdit($values);

?>