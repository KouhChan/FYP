
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

// Reference to database
var contactFormDB = firebase.database().ref("Notification");

// Get form from HTML
document.getElementById("Notification").addEventListener("submit", function (e) {
    e.preventDefault();

    // Display a confirmation dialog with options to Add or Cancel
    var confirmed = window.confirm("Do you want to add this notification?");
    if (confirmed) {
        // If user confirms, proceed with form submission
        var NotificationID = "NID001"; // Initial Bus ID
        var Description = getElementVal('description');
        var admin = getElementVal('admin');

        // Check if the initial Bus ID is already registered
        contactFormDB.child(NotificationID).once('value', function (snapshot) {
            if (snapshot.exists()) {
                // If Bus ID already exists, find the next available ID
                getNextAvailableID();
            } else {
                // If Bus ID is not registered, save the message with the initial ID
                saveMessage(NotificationID, Description, admin);
            }
        });
    } else {
        // If user cancels, show a message or perform any other desired action
        alert("Notification addition cancelled.");
    }
});

// Function to get the next available ID
function getNextAvailableID() {
    contactFormDB.once('value', function (snapshot) {
        // Initialize the next ID as B001
        var nextID = "NID001";

        // Loop through each child node in the database
        snapshot.forEach(function (childSnapshot) {
            var key = childSnapshot.key;
            // Extract the numeric part of the Bus ID and convert it to a number
            var numericID = parseInt(key.substring(3));

            // If the numeric part of the ID is greater than or equal to the current next ID, increment it
            if (numericID >= parseInt(nextID.substring(3))) {
                nextID = "NID" + ("000" + (numericID + 1)).slice(-3); // Format the ID as BXXX
            }
        });

        // After finding the next available ID, save the message with that ID
        var Description = getElementVal('description');
        var admin = getElementVal('admin');
        saveMessage(nextID, Description, admin);
    });
}

// Function to save the bus details to the database
function saveMessage(NotificationID, Description, admin) {
    // Get the current time
    var currentTime = new Date();
    var formattedTime = currentTime.toLocaleString();


    var newNotification = contactFormDB.child(NotificationID);

    newNotification.set({
        NotificationID: NotificationID,
        Description: Description,
        User: admin,
        Time: formattedTime,
    })
        .then(() => {
            // Redirect to view_bus.php
            window.location.href = "../Bus/View_Bus.php";

            // Show success notification
            alert("Notification successfully registered!");
        })
        .catch(error => {
            console.error("Error registering bus:", error);
            // Show error notification
            alert("Error submit Notification. Please try again.");
        });
}

// Function to get the value of an HTML element by ID
function getElementVal(id) {
    return document.getElementById(id).value;
}