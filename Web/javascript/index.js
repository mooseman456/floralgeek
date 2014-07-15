// File name: index.js
// File author: Joe St. Angelo
// 
// File is to be used for the Floralgeek Sales Database

// Root URL used for AJAX calls to the Slim application
var rootURL = "Slim/index.php";


var returnData;

var searchCat = "notGood";
var searchCat2 = "simple";

var searchTerm;
var searchTerm2;

var GoL;
var GoL2;

var page=0;
var maxSize;
var maxPage;
var query;
var orderBy;
var table;
var sort;

$(document).ready(function() {

    // Hides all the possible forms for the user
    // to search by, and shows only the ones
    // relevant to the topic chosen
    $(".group").hide();
    $(".group2").hide();
    $("#catPicker").change(function () {
        $(".picked").show();
        $(".picked").removeClass("picked");
        if ($(this).val() === "state") {
            searchCat = "state";
            $(".group").hide();
            $("#stateCat2").addClass("picked");
            $("#state").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        else if($(this).val() === "rooms") {
            searchCat = "rooms";
            $(".group").hide();
            $("#roomsCat2").addClass("picked");
            $("#GToLT").show();
            $("#query").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        else if($(this).val() === "rate") {
            searchCat = "rate";
            $(".group").hide();
            $("#rateCat2").addClass("picked");
            $("#GToLT").show();
            $("#query").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        else if($(this).val() === "type") {
            searchCat = "type";
            $(".group").hide();
            $("#typeCat2").addClass("picked");
            $("#type").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        else if($(this).val() === "interestLvl") {
            searchCat = "interestLvl";
            $(".group").hide();
            $("#GToLT").show();
            $("#interestLvl").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        else if ($(this).val() === "notGood"){
            searchCat = "notGood";
            $(".group").hide();
            $(".group2").hide();
        }

        else {
            searchCat = $(this).val();
            $(".group").hide();
            $("#" + searchCat + "Cat2").addClass("picked");
            $("#query").show();
            $("#submitButton").show();
            $("#catPicker2").show();
        }
        $(".picked").hide();

    });

    $("#catPicker2").change(function () {
        
        if ($(this).val() === "state") {
            searchCat2 = "state";
            $(".group2").hide();
            $("#state2").show();
            $("#submitButton").show();
        }
        else if($(this).val() === "rooms") {
            searchCat2 = "rooms";
            $(".group2").hide();
            $("#GToLT2").show();
            $("#query2").show();
            $("#submitButton").show();
        }
        else if($(this).val() === "rate") {
            searchCat2 = "rate";
            $(".group2").hide();
            $("#GToLT2").show();
            $("#query2").show();
            $("#submitButton").show();
        }
        else if($(this).val() === "type") {
            searchCat2 = "type";
            $(".group2").hide();
            $("#type2").show();
            $("#submitButton").show();
        }
        else if($(this).val() === "interestLvl") {
            searchCat2 = "interestLvl";
            $(".group2").hide();
            $("#GToLT2").show();
            $("#interestLvl2").show();
            $("#submitButton").show();
        }
        else if ($(this).val() === "simple"){
            searchCat2 = "simple";
            //$(".group").hide();
            $(".group2").hide();
        }
        else {
            searchCat2 = $(this).val();
            $(".group2").hide();
            $("#query2").show();
            $("#submitButton").show();
        }
        $("#catPicker2").show();
    });
    
    // If a category that's sortable is clicked,
    // this grabs whether it is going to be sorted
    // ascending or descending, and then sorts it.
    $(".sortCat").click(function(e) {
        table = $(this).data("table");
        sort = $(this).data("order");
        
        if (sort === "ASC")
            $(this).data("order", "DESC");
        else
            $(this).data("order", "ASC");
        
        orderResults();
    });    

    // When the user has finished filling out their search form
    $("#submitButton").click(function(e){
        e.preventDefault();
        var canSubmit = true;

        // Checks to make sure the query has been filled out
        if ((searchCat !== "state" && searchCat !=="type" && searchCat !== "interestLvl") && ($("#query").val() === "")) {
            alert("Please input a search term");
        }
        else {
            switch(searchCat) {
                case "state":
                    searchTerm = $("#state").val();
                    break;
                case "rooms":
                case "rate":
                    searchTerm = $("#query").val();
                    GoL = $("#GToLT").val();
                    break;
                case "interestLvl":
                    searchTerm = $("#interestLvl").val();
                    GoL = $("#GToLT").val();
                    break;
                case "type":
                    searchTerm = $("#type").val();
                    break;
                default:
                    searchTerm = $("#query").val();
                    break;
            }
            switch(searchCat2) {
                case "state":
                    searchTerm2 = $("#state2").val();
                    break;
                case "rooms":
                case "rate":
                    searchTerm2 = $("#query2").val();
                    GoL2 = $("#GToLT2").val();
                    break;
                case "interestLvl":
                    searchTerm2 = $("#interestLvl2").val();
                    GoL2 = $("#GToLT2").val();
                    break;
                case "type":
                    searchTerm2 = $("#type2").val();
                    break;
                case "simple":
                    searchTerm2 = "";
                    break;
                default:
                    searchTerm2 = $("#query2").val();
                    break;
            }
            page = 0;
            submitQuery();
        }
   }); 
});

// Submits the query to the Slim application for
// retrieval of the contacts
function submitQuery() {
    $.ajax({
        type: 'POST',
        url: 'php/loadContacts.php',
        data: {
            searchCat: searchCat,
            searchCat2: searchCat2,
            searchTerm: searchTerm,
            searchTerm2: searchTerm2,
            GoL: GoL,
            GoL2: GoL2
        }
    })
    // When successfully complete, all previously
    // returned results will be removed, various
    // variables reset, and the table then
    // populated with the new results.
    .done( function(data, status){
        $(".results").remove();
        //console.log(data);
        returnData = jQuery.parseJSON(data);
        maxSize = parseInt(returnData[returnData.length-1]);
        maxPage = Math.floor(maxSize / 40);
        orderBy = null;
        query = returnData[returnData.length-2];
        console.log(query);
        populateTable();
    })
    .fail( function(data, status){
        alert(status);
    })
}

function nextPage() {
    page++;
    changePage();
};

function lastPage() {
    page = maxPage-1;
    changePage();
};

function prevPage() {
    page--;
    changePage();
};

function firstPage() {
    page = 0;
    changePage();
};

function changePage() {
    $.ajax({
        type: 'POST',
        url: 'php/changePage.php',
        data: {
            root: query,
            orderBy: orderBy,
            start: page*40
        }
    })
    .done( function(data, status){
        $(".results").remove();
        returnData = JSON.parse(data);
        populateTable();
    })
    .fail( function(data, status){
        console.log(jqXHR.responseText);
    })
}

// Sorts the results into ascending or descending
// order, dependent upon which category was 
// clicked on.
function orderResults() {
    $.ajax({
        type: 'POST',
        url: 'php/orderResults.php',
        data: {
            root: query,
            table: table,
            sort: sort
        }
    })
    .done( function(data, status){
        $(".results").remove();
        returnData = jQuery.parseJSON(data);
        page = 0;
        orderBy = returnData[returnData.length-1];
        populateTable();
    })
    .fail( function(data, status){
        console.log(jqXHR.responseText);
    })
}

// The meat of this page. Called after a query is submitted.
// Populates the table with the results.
function populateTable() {

    console.log(typeof returnData);
    console.log(returnData);
    
    var i = 0;

    // Makes sure that there were actually results found.
    if (maxSize === 0) {
        alert("Sorry, no results were found.");
    }
    else {
        // Limits the number of results per page to at most 40, or
        // to the remainder of the max size divided by 40 if it is
        // on the "last" page. Appends the necessary HTML elements
        // to the table.
        while(i < 40 && (page < maxPage || i < maxSize % 40 )){
            $("#resultTable").append("<tr id=row" + i + " data-id=" + i + " class=\"results\">");
            $("#row"+i).append("<td>" + returnData[i]['businessType'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['businessName'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['city'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['state'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['addressTwo'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['numLocations'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['numRooms'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['rate'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['GDS'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['mngtCo'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['contactPerson'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['phone'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['personEmail'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['dateOfLast'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['dateOfNext'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['interestLvl'] + "</td>");
            $("#row"+i).append("<td>" + returnData[i]['SPAssigned'] + "</td>");
            $("#resultTable").append("</tr>");

            // When a row is clicked, this will send all of the data to the
            // add_edit.php page, so that it can be edited.
            $("#row"+i).click(function(e){
                toEdit(returnData[$(this).data("id")]);
            });
            i++;
        }

        // Appends buttons to navigate to other pages dependent upon which
        // page the user is currently on.
        if (page !== 0) {
            $("body").append("<a id='first' class='results nav' href='#'>First</a>");
            $("#first").click(function(e) {
                e.preventDefault();
                firstPage();
            });
            $("body").append("<a id='prev' class='results nav' href='#'>Previous</a>");
            $("#prev").click(function(e) {
                e.preventDefault();
                prevPage();
            });
        }
        if (page < maxPage-1) {
            $("body").append("<a id='next' class='results nav' href='#'>Next</a>");
            $("#next").click(function(e) {
                e.preventDefault();
                nextPage();
            });
            $("body").append("<a id='last' class='results nav' href='#'>Last</a>");
            $("#last").click(function(e) {
                e.preventDefault();
                lastPage();
            });
        }

        console.log("Done");
    }
};

// Form of code found at http://mentaljetsam.wordpress.com/2008/06/02/using-javascript-to-post-data-between-pages/
// Used to transfer the information from the clicked contact to the add_edit.php
// page in order to be edited. 

function toEdit(row){
    console.log(row['contactID']);
    var form = document.createElement("form");
    form.method="post";
    form.action="add_edit.php";
    for (var d in row) {
        var input = document.createElement("input");
        input.setAttribute("name", d);
        input.setAttribute("value", row[d]);
        form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit();
};