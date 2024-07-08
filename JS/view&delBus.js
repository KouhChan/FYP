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

// Reference to your Firebase Realtime Database
const database = firebase.database();

// Reference to the 'Bus' node in database
const busRef = database.ref('Bus');

// Function to fetch bus data from Firebase
function fetchBusData() {
    busRef.on('value', function (snapshot) {

        //refresh the table
        document.getElementById('busTableBody').innerHTML = '';

        snapshot.forEach(function (childSnapshot) {
            const childData = childSnapshot.val();
            const busID = childData.BusID;
            const platNo = childData.PlatNo;
            const personIncharge = childData.PersonIncharge;
            const dateCreated = childData.Date;


            const tableRow = `<tr>
                                <td>${busID}</td>
                                <td>${platNo}</td>
                                <td>${personIncharge}</td>
                                <td>${dateCreated}</td>
                                <td style="text-align: center;">
                                    <a href='modifyBus.php?bus_id=${busID}' class='modify-button'>Update</a>
                                    <a href='#' onclick="deleteBus('${busID}')"class='remove-button space'>Remove</a>
                                </td>
                            </tr>`;
            document.getElementById('busTableBody').innerHTML += tableRow;
        });
    });
}


// deleteBus.js

function deleteBus(busID) {
    // Ask for confirmation before deleting the bus
    if (confirm("Are you sure you want to delete this bus?")) {
        // Reference to the specific bus node in the database
        const busToDeleteRef = busRef.child(busID);

        // Remove the bus node from the database
        busToDeleteRef.remove()
            .then(function () {
                console.log("Bus information deleted successfully.");
            })
            .catch(function (error) {
                console.error("Error deleting bus information:", error);
            });
    } else {
        console.log("Deletion cancelled.");
    }
}


// Call the function to fetch and populate bus data
fetchBusData();