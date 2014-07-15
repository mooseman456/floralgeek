<?php 
    // File name: index.php
    // File author: Joe St. Angelo
    // 
    // File is to be used for the Floralgeek Sales Database

session_start();
    // This is just to make sure that if they click "Add new entry,"
    // the page doesn't load a possibly previously loaded contact
$_SESSION['contactID'] = -1;
?>

<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Floral Geek Admin Page</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
    <script src="javascript/index.js"></script>
</head>

<body>
    <div>
        <a href="add_edit.php">Add a new entry</a>
    </div>
    <form id="searchForm">
        <select id="catPicker">
            <option value="notGood">Select a category...</option>
            <option value="type">Business Type</option>
            <option value="name">Name</option>
            <option value="city">City</option>
            <option value="state">State</option>
            <option value="country">Country Abbr.</option>
            <option value="interestLvl">Interest Level</option>
            <option value="rooms"># of Rooms</option>
            <option value="rate">Average Rate</option>
            <option value="GDS">GDS</option>
            <option value="managementCo">Management Company</option>
            <!--<option value="followUp">Follow Up Date</option> -->
            <!-- <option value="id">ID Number</option> -->

        </select>
        <select id="type" class="group" name="type">
            <option value="H">Hotel</option>
            <option value="HC">Hotel Chains</option>
            <option value="R">Rep Company</option>
            <option value="M">Management Company</option>
            <option value="F">Florist</option>
            <option value="C">Consultant</option>
            <option value="V">Vendor</option>
            <option value="P">PMS Company</option>
            <option value="RE">Real Estate</option>
            <option value="G">Golf</option>
            <option value="A">Airlines</option>
            <option value="O">Other</option>
        </select>
        <select id="GToLT" class="group">
            <option value="less">Less Than</option>
            <option value="equal">Equal To</option>
            <option value="greater">Greater Than</option>
        </select>

        <input id="query" class="group" type="text" name="query" placeholder="Search Term">

        <select id="state" class="group" name="state">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>

        <select id="interestLvl" class="group">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
        </select>


        <select id="catPicker2" class="group2">
            <option value="simple">No Second Category</option>
            <option id="typeCat2" value="type">Business Type</option>
            <option id="nameCat2" value="name">Name</option>
            <option id="cityCat2" value="city">City</option>
            <option id="stateCat2" value="state">State</option>
            <option id="countryCat2" value="country">Country Abbr.</option>
            <option id="interestLvlCat2" value="interestLvl">Interest Level</option>
            <option id="roomsCat2" value="rooms"># of Rooms</option>
            <option id="rateCat2" value="rate">Average Rate</option>
            <option id="GDSCat2" value="GDS">GDS</option>
            <option id="managementCoCat2" value="managementCo">Management Company</option>
            <!--<option value="followUp">Follow Up Date</option> -->
            <!-- <option value="id">ID Number</option> -->

        </select>
        <select id="type2" class="group2" name="type">
            <option value="H">Hotel</option>
            <option value="HC">Hotel Chains</option>
            <option value="R">Rep Company</option>
            <option value="M">Management Company</option>
            <option value="F">Florist</option>
            <option value="C">Consultant</option>
            <option value="V">Vendor</option>
            <option value="P">PMS Company</option>
            <option value="RE">Real Estate</option>
            <option value="G">Golf</option>
            <option value="A">Airlines</option>
            <option value="O">Other</option>
        </select>

        <select id="GToLT2" class="group2">
            <option value="less">Less Than</option>
            <option value="equal">Equal To</option>
            <option value="greater">Greater Than</option>
        </select>

        <input id="query2" class="group2" type="text" name="query" placeholder="Search Term">

        <select id="state2" class="group2" name="state">
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>

        <select id="interestLvl2" class="group2">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
        </select>


        <input id="submitButton" class="group" type="submit" value="Submit Query">
    </form>
    <table id="resultTable">
        <tr>
            <th class="sortCat selected" data-order="ASC" data-table="businessType">Business Type</th>
            <th class="sortCat" data-order="ASC" data-table="businessName">Business Name</th>
            <th class="sortCat" data-order="ASC" data-table="city">City</th>
            <th>State</th>
            <th class="sortCat" data-order="ASC" data-table="addressTwo">Country</th>
            <th>Locations</th>
            <th class="sortCat" data-order="DESC" data-table="numRooms"># of Rooms</th>
            <th class="sortCat" data-order="DESC" data-table="rate">Avg. Rate</th>
            <th class="sortCat" data-order="ASC" data-table="GDS">GDS ID</th>
            <th class="sortCat" data-order="ASC" data-table="mngtCo">Management Company</th>
            <th>Contact Person</th>
            <th>Contacts Phone</th>
            <th>Email</th>
            <th>Date of Last Contact</th>
            <th class="sortCat" data-order="ASC" data-table="dateOfNext">Date Followup</th>
            <th class="sortCat" data-order="ASC" data-table="interestLvl">Interest Level</th>
            <th>Sales Person</th>
        </tr>
    </table>

</body>
</html>
