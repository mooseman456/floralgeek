<?php
// File name: Slim\index.php
// File author: Joe St. Angelo
// 
// File is to be used for the Floralgeek Sales Database

// Retrieves contacts based on what the user searched by
function loadContacts($searchCat, $searchCat2, $searchTerm, $searchTerm2, $GoL, $GoL2) {
  $mysqli = getConnection();
  
  
  try {
    switch($searchCat) {
      
      case "type":
        $root = "WHERE businessType = '$searchTerm'";
        break;
      case "name":
        $root = "WHERE businessName LIKE '$searchTerm%'";
        break;
      case "city":
        $root = "WHERE city = '$searchTerm'";
        break;
      case "state":
        $root = "WHERE state = '$searchTerm'";
        break;
      case "country":
        $root = "WHERE addressTwo = '$searchTerm'";
        break;
      case "GDS":
        $root = "WHERE GDS LIKE '$searchTerm%'";
        break;
      case "managementCo":
        $root = "WHERE mngtCo = '$searchTerm'";
        break;

      case "rooms":
        if ($GoL == "less") {
          $root = "WHERE numRooms <= $searchTerm";
        } else if($GoL == "equal") {
          $root = "WHERE numRooms = $searchTerm";
        } else {
          $root = "WHERE numRooms >= $searchTerm";
        }        
        break;
      
      case "rate":
        if ($GoL == "less") {
          $root = "WHERE rate <= $searchTerm";
        } else if($GoL == "equal") {
          $root = "WHERE rate = $searchTerm";
        } else {
          $root = "WHERE rate >= $searchTerm";
        }        
        break;

      case "interestLvl":
        if ($GoL == "less") {
          $root = "WHERE interestLvl <= $searchTerm";
        } else if($GoL == "equal") {
          $root = "WHERE interestLvl = $searchTerm";
        } else {
          $root = "WHERE interestLvl >= $searchTerm";
        }        
        break;

      default:
        throw new Exception("Could not find the thing");
        break;

    };
    switch($searchCat2) {
      
      case "type":
        $root .= " AND businessType = '$searchTerm2'";
        break;
      case "name":
        $root .= " AND businessName LIKE '$searchTerm2%'";
        break;
      case "city":
        $root .= " AND city = '$searchTerm2'";
        break;
      case "state":
        $root .= " AND state = '$searchTerm2'";
        break;
      case "country":
        $root .= " AND addressTwo = '$searchTerm2'";
        break;
      case "GDS":
        $root .= " AND GDS LIKE '$searchTerm2%'";
        break;
      case "managementCo":
        $root .= " AND mngtCo = '$searchTerm2'";
        break;

      case "rooms":
        if ($GoL2 == "less") {
          $root .= " AND numRooms <= $searchTerm2";
        } else if($GoL2 == "equal") {
          $root .= " AND numRooms = $searchTerm2";
        } else {
          $root .= " AND numRooms >= $searchTerm2";
        }        
        break;
      
      case "rate":
        if ($GoL2 == "less") {
          $root .= " AND rate <= $searchTerm2";
        } else if($GoL2 == "equal") {
          $root .= " AND rate = $searchTerm2";
        } else {
          $root .= " AND rate >= $searchTerm2";
        }        
        break;

      case "interestLvl":
        if ($GoL2 == "less") {
          $root .= " AND interestLvl <= $searchTerm2";
        } else if($GoL2 == "equal") {
          $root .= " AND interestLvl = $searchTerm2";
        } else {
          $root .= " AND interestLvl >= $searchTerm2";
        }        
        break;

      case "simple":
        break;

      default:
        throw new Exception("Could not find the thing");
        break;

    };

    // Retrieves the number of results, maxing out at 400
    $countPref = "SELECT COUNT(*) FROM (SELECT * FROM contacts $root LIMIT 0, 400) AS a;";
    $countResult = $mysqli->query($countPref) or trigger_error($mysqli->error."[$countPref]");
    $count = mysqli_fetch_assoc($countResult)['COUNT(*)'];
  
    // Actually submits the query to retrieve the contacts, at 40 results at a time.
    $query = "SELECT * FROM contacts $root ORDER BY businessName ASC LIMIT 0, 40;" ;
    
    $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");

    // Stores all the rows into an array, along with
    // the root of the query, and the number of results,
    // which is then JSON encoded and echo'd for the javscript
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
    }

    $rows[] = $root;
    $rows[] = $count;
    $result = json_encode($rows);
    echo $result;
    //echo $query;
  }
  catch(Exception $e){
  }
  $mysqli->close();
}

// Retrieves a single contact, which is used for... nothing?
function retrieveContact($id){
  $mysqli = getConnection();

  $query = "SELECT * FROM contacts WHERE contactID = $id";
  $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
  echo $result;

  $mysqli->close();
}

// When the user changes page. Results returned depend upon the page
// they are on, which is sent in by the JS.
function changePage($root, $start, $orderBy) {
  $mysqli = getConnection();

  $query = "SELECT * FROM contacts $root $orderBy LIMIT $start, 40;";

  $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
  $rows = array();
  while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }

  $result = json_encode($rows);
  echo $result;

  $mysqli->close();

}

// Sorts the results by whatever the user clicked in ascending
// or descending order.
function orderResults($root, $table, $sort) {
  $mysqli = getConnection();
  if ($table == "GDS")
    $root = "$root AND GDS != '' ORDER BY $table $sort";
  else
    $root = "$root ORDER BY $table $sort";

  $query = "SELECT * FROM contacts $root LIMIT 0, 40";

  $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
  $rows = array();
  while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }

  // Returns the new "root" for use when changing pages.
  $rows[] = "ORDER BY $table $sort";

  $result = json_encode($rows);
  echo $result;
  
  //echo $query;
  $mysqli->close();
}


// This is used to either add or edit a contact
// if a category is supplied by the JS,
// then it concats the necessary information onto both the queries.
function addEdit($values) {
  $mysqli = getConnection();

  $updateQuery = "UPDATE contacts SET `businessName` = '" .$values['businessName']. "', `businessType` = '" .$values['businessType']. "', `addressOne` = '" .$values['addressOne']. "', `city` = '" .$values['city']. "', `state` = '" .$values['state']. "', `zip` = '" .$values['zip']. "'";

  $tableList = "`businessName`, `businessType`, `addressOne`, `city`, `state`, `zip`";
  $valueList =  "\"" .$values['businessName']. "\", \"" .$values['businessType']. "\", \"" .$values['addressOne']. "\", \"" .$values['city']. "\", \"" .$values['state']. "\", \"" .$values['zip']. "\"";

  if ($values['addressTwo'] != "") {
    $tableList .= ", `addressTwo`";
    $valueList .= ", \"" . $values['addressTwo']. "\"";
    $updateQuery .= ", `addressTwo` = '" .$values['addressTwo']. "'";
  }

  if ($values['numLocations'] != "") {
    $tableList .= ", `numLocations`";
    $valueList .= ", \"" . $values['numLocations']. "\""; 
    $updateQuery .= ", `numLocations` = '" .$values['numLocations']. "'";
  }

  if ($values['numRooms'] != "") {
    $tableList .= ", `numRooms`";
    $valueList .= ", \"" . $values['numRooms']. "\"";
    $updateQuery .= ", `numRooms` = " .$values['numRooms'];
  }

  if ($values['rate'] != "") {
    $tableList .= ", `rate`";
    $valueList .= ", \"" . $values['rate']. "\"";
    $updateQuery .= ", `rate` = " .$values['rate'];
  }

  if ($values['GDS'] != "") {
    $tableList .= ", `GDS`";
    $valueList .= ", \"" . $values['GDS']. "\"";
    $updateQuery .= ", `GDS` = '" .$values['GDS']. "'";
  }

  if ($values['mngtCo'] != "") {
    $tableList .= ", `mngtCo`";
    $valueList .= ", \"" . $values['mngtCo']. "\"";
    $updateQuery .= ", `mngtCo` = '" .$values['mngtCo']. "'";
  }

  if ($values['contactPerson'] != "") {
    $tableList .= ", `contactPerson`";
    $valueList .= ", \"" . $values['contactPerson']. "\"";
    $updateQuery .= ", `contactPerson` = '" .$values['contactPerson']. "'";
  }

  if ($values['personPhone'] != "") {
    $tableList .= ", `personPhone`";
    $valueList .= ", \"" . $values['personPhone']. "\"";
    $updateQuery .= ", `personPhone` = '" .$values['personPhone']. "'";
  }

  if ($values['personEmail'] != "") {
    $tableList .= ", `personEmail`";
    $valueList .= ", \"" . $values['personEmail']. "\"";
    $updateQuery .= ", `personEmail` = '" .$values['personEmail']. "'";
  }

  if ($values['followUp'] != "") {
    $tableList .= ", `dateOfNext`";
    $valueList .= ", \"" .$values['followUp']. "\"";
    $updateQuery .= ", `dateOfNext` = '" .$values['followUp']. "'";
  }

  if ($values['interestLvl'] != "") {
    $tableList .= ", `interestLvl`";
    $valueList .= ", \"" . $values['interestLvl']. "\"";
    $updateQuery .= ", `interestLvl` = " .$values['interestLvl'];
  }

  if ($values['SPAssigned'] != "") {
    $tableList .= ", `SPAssigned`";
    $valueList .= ", \"" . $values['SPAssigned']. "\"";
    $updateQuery .= ", `SPAssigned` = '" .$values['SPAssigned']. "'";
  }

  if ($values['contactID'] != "-1") {
    $query = "$updateQuery WHERE contactID = " .$values['contactID']. ";";
    $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
    $id = $values['contactID'];
  }
  else {
    $query = "INSERT INTO contacts ($tableList) VALUES ($valueList);";
    $mysqli->query($query) or trigger_error($mysqli->error."[$query]"); 
    $id = $mysqli->insert_id;
  }
  

  $query = "SELECT * FROM contacts WHERE contactID = $id";
  
  $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");

  $result = json_encode(mysqli_fetch_assoc($result));
  echo $result;
  
  $mysqli->close();
}

// Adds a conversation for a contact, and also updates the date of last conversation for 
// that specific contact.
function addConversation($contactID, $conversationDate, $conversationSP, $conversation, $followUp, $interestLvl, $conversationID) {
  $mysqli = getConnection();
  //echo $conversation;
  if ($conversationID == -1)
    $query = "INSERT INTO conversations (`contactID`, `date`, `SP`, `conversation`, `followUp`, `interestLvl`) VALUES ($contactID, \"$conversationDate\", \"$conversationSP\", \"$conversation\", \"$followUp\", $interestLvl);";
  else
    $query = "UPDATE conversations SET `date` = \"$conversationDate\", `SP` = \"$conversationSP\", `conversation` = \"$conversation\", `followUp` = \"$followUp\", `interestLvl` = $interestLvl WHERE conversationID = $conversationID;";
  //echo $query;

  
  $mysqli->query($query) or trigger_error($mysqli->error."[$query]");

  $query = "UPDATE contacts SET `dateOfLast` = \"$conversationDate\", `interestLvl` = $interestLvl, `dateOfNext` = \"$followUp\" WHERE contactID = $contactID;";

  $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
  $mysqli->close();
}

// Fetches all the conversations in order of newest to oldest for a specific contact
function loadConversations($contactID) {
  $mysqli = getConnection();

  $query = "SELECT * FROM conversations WHERE contactID = $contactID ORDER BY date DESC;";

  
  $result = $mysqli->query($query) or trigger_error($mysqli->error."[$query]");
  
  $rows = array();
  while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }

  $result = json_encode($rows);

  echo $result;
  $mysqli->close();
}



// Creates a connection for the MySQL database
function getConnection() {
  $dbhost='localhost';
  $dbuser='root';
  $dbpass='root';
  $dbname='floralgeek';
  $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
  return $db;
}


?>