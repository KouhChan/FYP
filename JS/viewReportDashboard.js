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
const reportRef = database.ref('Report');

// Function to fetch bus data from Firebase and populate the table
function fetchReportData() {
    reportRef.limitToLast(5).on('value', function (snapshot) {

        //refresh the table
        document.getElementById('busTableBody').innerHTML = '';

        snapshot.forEach(function (childSnapshot) {
            const childData = childSnapshot.val();
            const Date = childData.Date;
            const ID = childData.ID;
            const Location = childData.Location;
            const Nama = childData.nama;
            const Report = childData.Report;

            // Append fetched data to the table
            const tableRow = `<tr>
                                <td>${ID}</td>
                                <td>${Date}</td>
                                <td>${Location}</td>
                                <td>${Report}</td>
                            </tr>`;
            document.getElementById('busTableBody').innerHTML += tableRow;
        });
    });
}


// deleteBus.js

function deleteReport(ID) {
    // Ask for confirmation before deleting the bus
    if (confirm("Are you sure you want to delete this report?")) {
        // Reference to the specific bus node in the database
        const reportToDeleteRef = reportRef.child(ID);

        // Remove the bus node from the database
        reportToDeleteRef.remove()
            .then(function () {
                console.log("Report information deleted successfully.");
            })
            .catch(function (error) {
                console.error("Error deleting Report information:", error);
            });
    } else {
        console.log("Deletion cancelled.");
    }
}


// Call the function to fetch and populate bus data
fetchReportData();