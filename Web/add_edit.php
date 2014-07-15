<?php
    // File name: add_edit.php
    // File author: Joe St. Angelo
    // 
    // File is to be used for the Floralgeek Sales Database
   
    session_start();

    // If the user is redirected here from clicking on an existing contact
    // or the page is refreshed after having added a new conversation
    if (isset($_POST['contactID']) && $_POST['contactID'] != -1) {
        $_SESSION['contactID'] = $_POST['contactID'];
        $_SESSION['businessType'] = $_POST['businessType'];
        $_SESSION['businessName'] = $_POST['businessName'];
        $_SESSION['addressOne'] = $_POST['addressOne'];
        $_SESSION['addressTwo'] = $_POST['addressTwo'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['zip'] = $_POST['zip'];
        $_SESSION['numLocations'] = $_POST['numLocations'];
        $_SESSION['numRooms'] = $_POST['numRooms'];
        $_SESSION['rate'] = $_POST['rate'];
        $_SESSION['GDS'] = $_POST['GDS'];
        $_SESSION['mngtCo'] = $_POST['mngtCo'];
        $_SESSION['contactPerson'] = $_POST['contactPerson'];
        $_SESSION['personPhone'] = $_POST['personPhone'];
        $_SESSION['personEmail'] = $_POST['personEmail'];
        $_SESSION['lastContact'] = "";
        $_SESSION['followUp'] = "";
        $_SESSION['interestLvl'] = $_POST['interestLvl'];
        $_SESSION['SPAssigned'] = $_POST['SPAssigned'];
    }
    // If the user is redirected here from clicking "Add new entry",
    // but not if they refreshed the page manually after having clicked
    // on an existing contact.  
    else if ($_SESSION['contactID'] == -1){
        $_SESSION['contactID'] = -1;
        $_SESSION['businessType'] = "H";
        $_SESSION['businessName'] = "";
        $_SESSION['addressOne'] = "";
        $_SESSION['addressTwo'] = "";
        $_SESSION['city'] = "";
        $_SESSION['state'] = "";
        $_SESSION['zip'] = "";
        $_SESSION['numLocations'] = "";
        $_SESSION['numRooms'] = "";
        $_SESSION['rate'] = "";
        $_SESSION['GDS'] = "";
        $_SESSION['mngtCo'] = "";
        $_SESSION['contactPerson'] = "";
        $_SESSION['personPhone'] = "";
        $_SESSION['personEmail'] = "";
        $_SESSION['lastContact'] = "";
        $_SESSION['followUp'] = "";
        $_SESSION['interestLvl'] = "";
        $_SESSION['SPAssigned'] = "";
    }   


?>

<!Doctype html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <title>Add/Editing Contact</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
        <script src="javascript/add_edit.js"></script>
    </head>
    <body>
        <a href="index.php">Back</a>
        <form data-id="<?=$_SESSION['contactID']?>">
            <div>
                <h2>General Information</h2>
                <ul>
                    <li>
                        <label for="type">Business Type *</label>
                        <select id="businessType" name="businessType" required>
                            <option value="H" <?=($_SESSION['businessType']=="H")? ' selected':''?>>Hotel</option>
                            <option value="HC" <?=($_SESSION['businessType']=="HC")? ' selected':''?>>Hotel Chains</option>
                            <option value="R" <?=($_SESSION['businessType']=="R")? ' selected':''?>>Rep Company</option>
                            <option value="M" <?=($_SESSION['businessType']=="M")? ' selected':''?>>Management Company</option>
                            <option value="F" <?=($_SESSION['businessType']=="F")? ' selected':''?>>Florist</option>
                            <option value="C" <?=($_SESSION['businessType']=="C")? ' selected':''?>>Consultant</option>
                            <option value="V" <?=($_SESSION['businessType']=="V")? ' selected':''?>>Vendor</option>
                            <option value="P" <?=($_SESSION['businessType']=="P")? ' selected':''?>>PMS Company</option>
                            <option value="RE" <?=($_SESSION['businessType']=="RE")? 'selected':''?>>Real Estate</option>
                            <option value="G" <?=($_SESSION['businessType']=="G")? 'selected':''?>>Golf</option>
                            <option value="A" <?=($_SESSION['businessType']=="A")? 'selected':''?>>Airlines</option>
                            <option value="O" <?=($_SESSION['businessType']=="O")? 'selected':''?>>Other</option>
                        </select>
                    </li>
                    <li>
                        <label for="businessName">Business Name *</label>
                        <input type="text" id="businessName" name="businessName" value="<?=$_SESSION['businessName']?>" required >
                    </li>
                </ul>
            </div>
            <div>
                <h2>Address Information</h2>
                <ul>
                    <li>
                        <label for="addressOne">Address One *</label>
                        <input type="text" class="address" id="addressOne" value="<?=$_SESSION['addressOne']?>" required>
                    </li>
                    <li>
                        <label for="city">City *</label>
                        <input type="text" id="city" value="<?=$_SESSION['city']?>" required>
                    </li>
                    <li>
                        <label for="state">State</label>
                        <select id="state" name="state">
                            <option value="N/A" <?=($_SESSION['state']=="N/A")? ' selected':''?>>N/A</option>
                            <option value="AL" <?=($_SESSION['state']=="AL")? ' selected':''?>>Alabama</option>
                            <option value="AK" <?=($_SESSION['state']=="AK")? ' selected':''?>>Alaska</option>
                            <option value="AZ" <?=($_SESSION['state']=="AZ")? ' selected':''?>>Arizona</option>
                            <option value="AR" <?=($_SESSION['state']=="AR")? ' selected':''?>>Arkansas</option>
                            <option value="CA" <?=($_SESSION['state']=="CA")? ' selected':''?>>California</option>
                            <option value="CO" <?=($_SESSION['state']=="CO")? ' selected':''?>>Colorado</option>
                            <option value="CT" <?=($_SESSION['state']=="CT")? ' selected':''?>>Connecticut</option>
                            <option value="DE" <?=($_SESSION['state']=="DE")? ' selected':''?>>Delaware</option>
                            <option value="DC" <?=($_SESSION['state']=="DC")? ' selected':''?>>District of Columbia</option>
                            <option value="FL" <?=($_SESSION['state']=="FL")? ' selected':''?>>Florida</option>
                            <option value="GA" <?=($_SESSION['state']=="GA")? ' selected':''?>>Georgia</option>
                            <option value="HI" <?=($_SESSION['state']=="HI")? ' selected':''?>>Hawaii</option>
                            <option value="ID" <?=($_SESSION['state']=="ID")? ' selected':''?>>Idaho</option>
                            <option value="IL" <?=($_SESSION['state']=="IL")? ' selected':''?>>Illinois</option>
                            <option value="IN" <?=($_SESSION['state']=="IN")? ' selected':''?>>Indiana</option>
                            <option value="IA" <?=($_SESSION['state']=="IA")? ' selected':''?>>Iowa</option>
                            <option value="KS" <?=($_SESSION['state']=="KS")? ' selected':''?>>Kansas</option>
                            <option value="KY" <?=($_SESSION['state']=="KY")? ' selected':''?>>Kentucky</option>
                            <option value="LA" <?=($_SESSION['state']=="LA")? ' selected':''?>>Louisiana</option>
                            <option value="ME" <?=($_SESSION['state']=="ME")? ' selected':''?>>Maine</option>
                            <option value="MD" <?=($_SESSION['state']=="MD")? ' selected':''?>>Maryland</option>
                            <option value="MA" <?=($_SESSION['state']=="MA")? ' selected':''?>>Massachusetts</option>
                            <option value="MI" <?=($_SESSION['state']=="MI")? ' selected':''?>>Michigan</option>
                            <option value="MN" <?=($_SESSION['state']=="MN")? ' selected':''?>>Minnesota</option>
                            <option value="MS" <?=($_SESSION['state']=="MS")? ' selected':''?>>Mississippi</option>
                            <option value="MO" <?=($_SESSION['state']=="MO")? ' selected':''?>>Missouri</option>
                            <option value="MT" <?=($_SESSION['state']=="MT")? ' selected':''?>>Montana</option>
                            <option value="NE" <?=($_SESSION['state']=="NE")? ' selected':''?>>Nebraska</option>
                            <option value="NV" <?=($_SESSION['state']=="NV")? ' selected':''?>>Nevada</option>
                            <option value="NH" <?=($_SESSION['state']=="NH")? ' selected':''?>>New Hampshire</option>
                            <option value="NJ" <?=($_SESSION['state']=="NJ")? ' selected':''?>>New Jersey</option>
                            <option value="NM" <?=($_SESSION['state']=="NM")? ' selected':''?>>New Mexico</option>
                            <option value="NY" <?=($_SESSION['state']=="NY")? ' selected':''?>>New York</option>
                            <option value="NC" <?=($_SESSION['state']=="NC")? ' selected':''?>>North Carolina</option>
                            <option value="ND" <?=($_SESSION['state']=="ND")? ' selected':''?>>North Dakota</option>
                            <option value="OH" <?=($_SESSION['state']=="OH")? ' selected':''?>>Ohio</option>
                            <option value="OK" <?=($_SESSION['state']=="OK")? ' selected':''?>>Oklahoma</option>
                            <option value="OR" <?=($_SESSION['state']=="OR")? ' selected':''?>>Oregon</option>
                            <option value="PA" <?=($_SESSION['state']=="PA")? ' selected':''?>>Pennsylvania</option>
                            <option value="RI" <?=($_SESSION['state']=="RI")? ' selected':''?>>Rhode Island</option>
                            <option value="SC" <?=($_SESSION['state']=="SC")? ' selected':''?>>South Carolina</option>
                            <option value="SD" <?=($_SESSION['state']=="SD")? ' selected':''?>>South Dakota</option>
                            <option value="TN" <?=($_SESSION['state']=="TN")? ' selected':''?>>Tennessee</option>
                            <option value="TX" <?=($_SESSION['state']=="TX")? ' selected':''?>>Texas</option>
                            <option value="UT" <?=($_SESSION['state']=="UT")? ' selected':''?>>Utah</option>
                            <option value="VT" <?=($_SESSION['state']=="VT")? ' selected':''?>>Vermont</option>
                            <option value="VA" <?=($_SESSION['state']=="VA")? ' selected':''?>>Virginia</option>
                            <option value="WA" <?=($_SESSION['state']=="WA")? ' selected':''?>>Washington</option>
                            <option value="WV" <?=($_SESSION['state']=="WV")? ' selected':''?>>West Virginia</option>
                            <option value="WI" <?=($_SESSION['state']=="WI")? ' selected':''?>>Wisconsin</option>
                            <option value="WY" <?=($_SESSION['state']=="WY")? ' selected':''?>>Wyoming</option>
                        </select>
                    </li>
                    <li>
                        <label for="addressTwo">Country Abbr.</label>
                        <input type="text" class="address" maxlength="3" id="addressTwo" value="<?=$_SESSION['addressTwo']?>">
                    </li>
                    <li>
                        <label for="zip">Zip Code *</label>
                        <input type="text" id="zip" title="Put 'N/A' if unknown or not-applicable" value="<?=$_SESSION['zip']?>"required>
                    </li>
                </ul>
            </div>
            <div>
                <h2>Location Information</h2>
                <ul>
                    <li>
                        <label for="numLocations"># of Locations</label>
                        <input type="text" id="numLocations" value="<?=$_SESSION['numLocations']?>">
                    </li>
                    <li>
                        <label for="numRooms"># of Rooms</label>
                        <input type="text" id="numRooms" value="<?=$_SESSION['numRooms']?>">
                    </li>
                    <li>
                        <label for="rate">Average Rate</label>
                        <input type="text" id="rate" value="<?=$_SESSION['rate']?>">
                    </li>
                    <li>
                        <label for="GDS">GDS ID</label>
                        <input type="text" id="GDS" value="<?=$_SESSION['GDS']?>">
                    </li>
                    <li>
                        <label for="mngtCo">Management Company</label>
                        <input type="text" id="mngtCo" "<?=$_SESSION['mngtCo']?>">
                    </li>
                </ul>
            </div>
            <div>
                <h2>Contact Information</h2>
                <ul>
                    <li>
                        <label for="contactPerson">Contact Person</label>
                        <input type="text" id="contactPerson" value="<?=$_SESSION['contactPerson']?>">
                    </li>
                    <li>
                        <label for="personPhone">Contact's Phone</label>
                        <input type="text" id="personPhone" value="<?=$_SESSION['personPhone']?>">
                    </li>
                    <li>
                        <label for="personEmail">Contact's Email</label>
                        <input type="text" id="personEmail" value="<?=$_SESSION['personEmail']?>">
                    </li>
                    <li>
                        <label for="SPAssigned">Sales Person's User ID</label>
                        <input type="text" id="SPAssigned"  maxlength="3" value="<?=$_SESSION['SPAssigned']?>">
                    </li>
                    <li>
                        <input type="submit" id="submitButton" value="Save Entry">
                    </li>
                </ul>
            </div>
        </form>
        <form>
            <h2>Conversations</h2>
            <button id="addNew">Add new</button>
            <table id="conversationTable">
                <tr id="conversationHeader">
                    <th class="conversationTable">Date of Conversation</th>
                    <th class="conversationTable">Follow up</th>
                    <th class="conversationTable">User ID</th>
                    <th class="conversationTable">Interest Level</th>
                    <th>Conversation</th>
                    
                </tr>
                <tr contact-id="-1" id="conversationFooter">
                    <td><input type="text" id="date" class="date" placeholder="MM/DD/YYYY" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" title="Format required: MM/DD/YYYY" required></td>
                    <td><input type="text" id="followUp" class="date" placeholder="MM/DD/YYYY" pattern="(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d" title="Format required: MM/DD/YYYY" value="<?=$_SESSION['followUp']?>" required></td>
                    <td><input type="text" maxlength="3" id="SP" required></td>
                    <td><select id="interestLvl" name="$_SESSION['interestLvl']">
                            <option value='1' <?=($_SESSION['interestLvl'] == "1")? ' selected':''?>>1</option>
                            <option value='2' <?=($_SESSION['interestLvl'] == "2")? ' selected':''?>>2</option>
                            <option value='3' <?=($_SESSION['interestLvl'] == "3")? ' selected':''?>>3</option>
                            <option value='4' <?=($_SESSION['interestLvl'] == "4")? ' selected':''?>>4</option>
                            <option value='5' <?=($_SESSION['interestLvl'] == "5")? ' selected':''?>>5</option>
                            <option value='6' <?=($_SESSION['interestLvl'] == "6")? ' selected':''?>>6</option>
                            <option value='7' <?=($_SESSION['interestLvl'] == "7")? ' selected':''?>>7</option>
                            <option value='8' <?=($_SESSION['interestLvl'] == "8")? ' selected':''?>>8</option>
                            <option value='9' <?=($_SESSION['interestLvl'] == "9")? ' selected':''?>>9</option>
                        </select></td>
                        <td><textarea id="conversation" required></textarea></td>
                    
                    <td class="conversationTable"><input type="submit" id="submitConversation" value="Save"></td>
                </tr>
            </table>

        </form>
    </body>
    </html>
