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

// Reference to the 'Admin' node in database
const AdminRef = database.ref('Admin');

// Function to fetch Admin data from Firebase
function fetchAdminData() {
    AdminRef.on('value', function (snapshot) {

        //refresh the table
        document.getElementById('busTableBody').innerHTML = '';

        snapshot.forEach(function (childSnapshot) {
            const childData = childSnapshot.val();
            const AdminID = childData.AdminID;
            const Nama = childData.Name;
            const Email = childData.Email;


            const tableRow = `<tr>
                                <td>${AdminID}</td>
                                <td>${Nama}</td>
                                <td>${Email}</td>
                                <td style="text-align: center;">
                                    <a href='modifyAdminPage.php?AdminID=${AdminID}' class='modify-button'>Update</a>
                                    <a href='#' onclick="deleteAdmin('${AdminID}')"class='remove-button space'>Remove</a>
                                </td>
                            </tr>`;
            document.getElementById('busTableBody').innerHTML += tableRow;
        });
    });
}


// deleteBus.js

function deleteAdmin(AdminID) {
    // Ask for confirmation before deleting the Admin
    if (confirm("Are you sure you want to delete this Admin?")) {
        // Reference to the specific Admin node in the database
        const adminToDeleteRef = AdminRef.child(AdminID);

        // Remove the Admin node from the database
        adminToDeleteRef.remove()
            .then(function () {
                console.log("Admin information deleted successfully.");
            })
            .catch(function (error) {
                console.error("Error deleting Admin information:", error);
            });
    } else {
        console.log("Deletion cancelled.");
    }
}

// Call the function to fetch and populate Admin data
fetchAdminData();