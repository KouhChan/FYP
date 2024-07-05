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

// Reference to Firebase Realtime Database
const database = firebase.database();

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const busID = urlParams.get('bus_id');

// Function to delete bus information
function deleteBus(busID) {
    // Reference to the bus node in the database
    const busRef = database.ref('Bus/' + busID);

    // Remove bus from the database
    busRef.remove().then(function () {
        console.log("Bus information deleted successfully.");
        // Redirect to View_Bus.php
        window.location.href = "View_Bus.php";
    }).catch(function (error) {
        console.error("Error deleting bus information:", error);
    });
}

// Call the deleteBus function with the desired BusID
const busIDToDelete = busID; 
deleteBus(busIDToDelete);
