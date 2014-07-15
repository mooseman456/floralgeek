// File name: add_edit.js
// File author: Joe St. Angelo
// 
// File is to be used for the Floralgeek Sales Database 

// Variable to hold the data for when the page needs to
// be refreshed by the web page itself.
var returnData;

// Variables for adding/editing a contact
var businessName;
var businessType;
var addressOne;
var addressTwo;
var city;
var state;
var zip;
var numLocations;
var numRooms;
var rate;
var GDS;
var mngtCo;
var personPhone;
var contactPerson;
var personEmail;
var lastContact;
var SPAssigned;

// Variables for adding a conversation
var conversation;
var conversationSP;
var conversationDate;
var followUp;
var interestLvl;
var conversationID;


$(document).ready(function(){
    contactID = $("form").data("id");
    
    // If the user is editing a contact, it may have conversations
    if (contactID != -1)
        retrieveConversations();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();

    if(dd < 10)
        dd = '0' + dd; 
    if(mm < 10)
        mm = '0' + mm;

    var today = mm+'/'+dd+'/'+yyyy;


    // Hides the form for a new conversation, 
    // unless the button to do so is clicked.
    $("#conversationFooter").hide();
    $("#addNew").click(function(e) {
        $("#conversationFooter").show();
        $("#date").val(today);
    });

    // If the user is ready to add/update a contact
    $("#submitButton").click(function(e){
        //e.preventDefault();
        var isComplete = true;
        getFormInfo();
        
        if (businessName === "")
            isComplete = false;
        
        if (addressOne === "")
            isComplete = false;    
        
        if (city === "")
            isComplete = false;

        if (zip === "")
            isComplete = false;
        
        if (isComplete === true) {
            e.preventDefault();

            addContact();
            //console.log(JSON.stringify(data));
        }
    });

    // If the user is ready to add a conversation
    $("#submitConversation").click(function(e){
        contactID = $("form").data("id");

        // Makes sure that the contact exists so as to not
        // cause a MySQL error
        if (contactID === -1) {
            alert("Please save this contact before adding a conversation");
            e.preventDefault();
        }
        else {
            conversationSP = $("#SP").val();
            conversationDate = $("#date").val();
            conversation = $("#conversation").val();
            interestLvl = $("#interestLvl").val();
            followUp = $("#followUp").val();
            conversationID = $("#conversationFooter").attr("conversation-id");
            var isComplete = true;

            if (conversationDate === "") {
                isComplete = false;
            }

            // From a user perspective, doing MM/DD/YYYY is the
            // most comfortable format. However, YYYY/MM/DD is 
            // the easiest to sort. So this converts it from the
            // former, to the latter.
            else {

                var month = conversationDate.substring(0, 2);
                var day = conversationDate.substring(3, 5);
                var year = conversationDate.substring(6);
                conversationDate = year + "/" + month + "/" + day;
            }
            if(conversationSP === "") {
                isComplete = false;
            }
            if(conversation === "") {
                isComplete = false;
            }
            if (followUp === "") {
                isComplete = false;
            }
            else {
                var month = followUp.substring(0, 2);
                var day = followUp.substring(3, 5);
                var year = followUp.substring(6);
                followUp = year + "/" + month + "/" + day;
            }
            if (isComplete) {
                e.preventDefault();
                addConversation();
            }
        }

    });

});

// AJAX call to the slim application to add a contact.
function addContact() {
    $.ajax({
        type: "POST",
        url: "php/addEdit.php",
        data: {

            businessName: businessName,
            businessType: businessType,
            addressOne: addressOne,
            addressTwo: addressTwo,
            city: city,
            state: state,
            zip: zip,
            numLocations: numLocations,
            numRooms: numRooms,
            rate: rate,
            GDS: GDS,
            mngtCo: mngtCo,
            contactPerson: contactPerson,
            personPhone: personPhone,
            personEmail: personEmail,
            lastContact: lastContact,
            SPAssigned: SPAssigned,
            contactID: contactID
        }
    })
    .done( function(data, status) {
        alert("Database successfully updated");
        // Stores all the information of the newly added contact
        // into a JSON object. This is for when adding a 
        // conversation, the page can auto-fill the
        // form
        returnData = JSON.parse(data);
        console.log(returnData['contactID']);
        
        // Changes the value of the "id" attribute so that the
        // rest of the application knows that the contact exists
        $("form").data("id", returnData['contactID']);
    })
    .fail( function(data, status) {
        console.log(status);
    });
};

// AJAX to add a conversation
function addConversation() {
    console.log(contactID);
    console.log(conversationSP);
    console.log(conversation);
    console.log(interestLvl);
    console.log(followUp);
    console.log(conversationDate);
    $.ajax({
        type: "POST",
        url: "php/addConversation.php",
        data: {
            contactID: contactID,
            conversationSP: conversationSP,
            conversation: conversation,
            interestLvl: interestLvl,
            followUp: followUp,
            conversationID: conversationID,
            conversationDate: conversationDate
        }
    })
    // When the function completes successfully,
    // the page reloads, packaging up the 
    // "returnData" values to be used
    // at the initial php of the page. 
    .done( function(data, status) {
        //getFormInfo();
        var form = document.createElement("form");
        form.method="post";
        form.action="add_edit.php";
        for (var d in returnData) {
            var input = document.createElement("input");
            input.setAttribute("name", d);
            input.setAttribute("value", returnData[d]);
            form.appendChild(input);
        }
        
        //console.log(data);
        form.submit();
    })
    .fail( function(data, status) {
        alert(status);
    }) 
}

// Loads all the conversations for the loaded contact.
// Called at the initial loading of the page.
function retrieveConversations() {
    $.ajax({
        type: "GET",
        url: "php/getConversation.php",
        data: {
            contactID: contactID
        }
    })
    // Uses jQuery to insert all the information into the table
    // containing all the conversations for that contact.
    .done( function(data, status) {

        data = JSON.parse(data);
        for (i = 0; i < data.length; i++) {
            var date = data[i]['date'].substring(5,7) + "/" + data[i]['date'].substring(8) + "/" + data[i]['date'].substring(0,4); 

            var followUp = data[i]['followUp'].substring(5,7) + "/" + data[i]['followUp'].substring(8) + "/" + data[i]['followUp'].substring(0,4); 

            $("#conversationTable").append("<tr class='conversation' value=" + i + " id='conversation" + i + "' conversation-id=" + data[i]['conversationID'] + ">");
            $("#conversation"+i).append("<td>" + date + "</td>");
            $("#conversation"+i).append("<td>" + followUp + "</td>");
            $("#conversation"+i).append("<td>" + data[i]['SP'] + "</td>");
            $("#conversation"+i).append("<td>" + data[i]['interestLvl'] + "</td>");
            $("#conversation"+i).append("<td>" + data[i]['conversation'] + "</td>");
            $("#conversation"+i).append("</tr>");
            
            $("#conversation"+i).click( function(e){
                var index = $(this).attr("value");
                //console.log(index);
                $(".clicked").show();
                $(".clicked").removeClass("clicked");
                $(this).addClass("clicked");
                $(this).hide();
                var date = data[index]['date'].substring(5,7) + "/" + data[index]['date'].substring(8) + "/" + data[index]['date'].substring(0,4); 

                var followUp = data[index]['followUp'].substring(5,7) + "/" + data[index]['followUp'].substring(8) + "/" + data[index]['followUp'].substring(0,4);
                $("#date").val(date);
                $("#followUp").val(followUp);
                $("#SP").val(data[index]['SP']);
                $("#interestLvl").val(data[index]['interestLvl']);
                $("#conversation").val(data[index]['conversation']);
                $("#conversationFooter").attr("conversation-id", data[index]['conversationID']);
                $("#conversationFooter").show();

            });
        }
    })
    .fail( function(data, status) {
        alert(status);
    })
}

// Gets the form data
function getFormInfo() {
    businessName = $("#businessName").val();
    businessType = $("#businessType").val();
    addressOne = $("#addressOne").val();
    addressTwo = $("#addressTwo").val();
    city = $("#city").val();
    state = $("#state").val();
    zip = $("#zip").val();
    numLocations = $("#numLocations").val();
    numRooms = $("#numRooms").val();
    rate = $("#rate").val();
    GDS = $("#GDS").val();
    mngtCo = $("#mngtCo").val();
    contactPerson = $("#contactPerson").val();
    personPhone = $("#personPhone").val();
    personEmail = $("#personEmail").val();
    SPAssigned = $("#SPAssigned").val();
    contactID = $("form").data("id");
}