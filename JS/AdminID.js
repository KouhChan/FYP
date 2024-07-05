// Reference to the database
const database = firebase.database();
const AdminRef = database.ref("Admin");

// Retrieve input values
var name = document.getElementById('nama').value;
var email = document.getElementById('email').value;
var password = document.getElementById('password').value;

// Generate next Admin ID
let nextId = "AD001";
AdminRef.once('value', function (snapshot) {
    snapshot.forEach(function (childSnapshot) {
        const key = childSnapshot.key;
        const numericId = parseInt(key.substring(2));
        if (numericId >= parseInt(nextId.substring(2))) {
            nextId = "AD" + ("000" + (numericId + 1)).slice(-3);
        }
    });

    // Set the generated next Admin ID to the input field
    const AdminIdInput = document.getElementById("AdminID");
    AdminIdInput.value = nextId;
    AdminIdInput.readOnly = true; // Make the input field readonly
    AdminIdInput.style.pointerEvents = "none";
});
