// Initialize Firebase
const firebaseConfig = {
    apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
    authDomain: "university-bus-system.firebaseapp.com",
    databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "university-bus-system",
    storageBucket: "university-bus-system.appspot.com",
    messagingSenderId: "446380655695",
    appId: "1:446380655695:web:ee019fad4684435252163a"
};
firebase.initializeApp(firebaseConfig);

// Reference to database
var contactFormDB = firebase.database().ref("Bus");

// Get form from HTML
document.getElementById("Bus").addEventListener("submit", submitForm);

function submitForm(e) {
    e.preventDefault();

    var BusID = "B001"; // Initial Bus ID
    var PlatNo = getElementVal('busPlat');
    var PersonIncharge = getElementVal('personIncharge');
    var Date = getElementVal('dateCreated');

    // Check if the initial Bus ID is already registered
    contactFormDB.child(BusID).once('value', function (snapshot) {
        if (snapshot.exists()) {
            // If Bus ID already exists, find the next available ID
            getNextAvailableID();
        } else {
            // If Bus ID is not registered, save the message with the initial ID
            saveMessage(BusID, PersonIncharge, Date, PlatNo);
        }
    });
};

// Function to get the next available ID
function getNextAvailableID() {
    contactFormDB.once('value', function (snapshot) {
        // Initialize the next ID as B001
        var nextID = "B001";

        // Loop through each child node in the database
        snapshot.forEach(function (childSnapshot) {
            var key = childSnapshot.key;
            // Extract the numeric part of the Bus ID and convert it to a number
            var numericID = parseInt(key.substring(1));

            // If the numeric part of the ID is greater than or equal to the current next ID, increment it
            if (numericID >= parseInt(nextID.substring(1))) {
                nextID = "B" + ("000" + (numericID + 1)).slice(-3); // Format the ID as BXXX
            }
        });

        // After finding the next available ID, save the message with that ID
        var PlatNo = getElementVal('busPlat');
        var PersonIncharge = getElementVal('personIncharge');
        var Date = getElementVal('dateCreated');
        saveMessage(nextID, PersonIncharge, Date, PlatNo);
    });
}

const saveMessage = (BusID, PersonIncharge, Date, PlatNo) => {
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
};

const getElementVal = (id) => {
    return document.getElementById(id).value;
};
