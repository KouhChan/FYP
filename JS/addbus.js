
// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
    authDomain: "university-bus-system.firebaseapp.com",
    databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "university-bus-system",
    storageBucket: "university-bus-system.appspot.com",
    messagingSenderId: "446380655695",
    appId: "1:446380655695:web:ee019fad4684435252163a"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);


var contactFormDB = firebase.database().ref("Bus");

// Get form from HTML
document.getElementById("Bus").addEventListener("submit", function (e) {
    e.preventDefault();

    // Display a confirmation to Add or Cancel
    var confirmed = window.confirm("Do you want to add this bus?");
    if (confirmed) {
        // If user confirms, proceed with form submission
        var BusID = "B001"; // Initial Bus ID
        var PlatNo = getElementVal('busPlat');
        var PersonIncharge = getElementVal('personIncharge');
        var Date = getElementVal('dateCreated');

        // Check if Bus ID is already registered
        contactFormDB.child(BusID).once('value', function (snapshot) {
            if (snapshot.exists()) {
                // If Bus ID already exists, 
                getNextAvailableID();
            } else {

                saveMessage(BusID, PersonIncharge, Date, PlatNo);
            }
        });
    } else {

        alert("Bus addition cancelled.");
    }
});

// Function to get the next available ID
function getNextAvailableID() {
    contactFormDB.once('value', function (snapshot) {
        // Initialize the next ID as B001
        var nextID = "B001";


        snapshot.forEach(function (childSnapshot) {
            var key = childSnapshot.key;

            var numericID = parseInt(key.substring(1));


            if (numericID >= parseInt(nextID.substring(1))) {
                nextID = "B" + ("000" + (numericID + 1)).slice(-3);
            }
        });


        var PlatNo = getElementVal('busPlat');
        var PersonIncharge = getElementVal('personIncharge');
        var Date = getElementVal('dateCreated');
        saveMessage(nextID, PersonIncharge, Date, PlatNo);
    });
}

// Function to save the bus details to the database
function saveMessage(BusID, PersonIncharge, Date, PlatNo) {
    var newBus = contactFormDB.child(BusID);

    newBus.set({
        BusID: BusID,
        Date: Date,
        PersonIncharge: PersonIncharge,
        PlatNo: PlatNo,
    })
        .then(() => {
            // Redirect to view_bus.php
            window.location.href = "../Bus/View_Bus.php";

            // Show success notification
            alert("Bus successfully registered!");
        })
        .catch(error => {
            console.error("Error registering bus:", error);
            // Show error notification
            alert("Error registering bus. Please try again.");
        });
}

// Function to get the value of an HTML element by ID
function getElementVal(id) {
    return document.getElementById(id).value;
}