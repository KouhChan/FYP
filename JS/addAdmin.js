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

var contactFormDB = firebase.database().ref("Admin");
var auth = firebase.auth();

document.getElementById("adminForm").addEventListener("submit", function (e) {
    e.preventDefault();

    // Display a confirmation dialog with options to Add or Cancel
    var confirmed = window.confirm("Do you want to add this Admin?");
    if (confirmed) {
        var AdminID = "AD001"; // Initial Admin ID
        var name = document.getElementById('nama').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        contactFormDB.child(AdminID).once('value', function (snapshot) {
            if (snapshot.exists()) {
                getNextAvailableID();
            } else {
                saveAdminToFirebase(AdminID, name, email, password);
            }
        });
    } else {
        alert("Admin addition cancelled.");
    }
});

//to get next available ID
function getNextAvailableID() {
    contactFormDB.once('value', function (snapshot) {
        var nextID = "AD001";

        snapshot.forEach(function (childSnapshot) {
            var key = childSnapshot.key;
            var numericID = parseInt(key.substring(2));

            if (numericID >= parseInt(nextID.substring(2))) {
                nextID = "AD" + ("000" + (numericID + 1)).slice(-3);
            }
        });

        var name = document.getElementById('nama').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;;
        saveAdminToFirebase(nextID, name, email, password);
    });
}

//save admin details in firebase database with login details for firebase authentication
function saveAdminToFirebase(AdminID, name, email, password) {
    auth.createUserWithEmailAndPassword(email, password)
        .then((userCredential) => {
            var user = userCredential.user;
            saveMessage(AdminID, name, email, password);
        })
        .catch((error) => {
            var errorCode = error.code;
            var errorMessage = error.message;
            console.error("Error registering Admin:", errorMessage); // Log error to console
            alert("Error registering Admin. Please try again.");
        });
}

//add the admin details into the firebase database
function saveMessage(AdminID, name, email, password) {
    var newAdmin = contactFormDB.child(AdminID);

    newAdmin.set({
        AdminID: AdminID,
        Name: name,
        Email: email,
        Password: password,
    })
    //forward the user to viewAdmin page
        .then(() => {
            window.location.href = "../Admin/viewAdmin.php";
            alert("Admin successfully registered!");
        })
        .catch(error => {
            console.error("Error registering Admin:", error); // Log error to console
            alert("Error registering Admin. Please try again.");
        });
}

function getElementVal(id) {
    return document.getElementById(id).value;
}
