// Reference to the database
const database = firebase.database();
const busRef = database.ref("Bus");

// Retrieve input values
const platNo = document.getElementById("busPlat").value;
const personIncharge = document.getElementById("personIncharge").value;
const dateCreated = document.getElementById("dateCreated").value;

// Generate next Bus ID
let nextId = "B001";
busRef.once('value', function (snapshot) {
    snapshot.forEach(function (childSnapshot) {
        const key = childSnapshot.key;
        const numericId = parseInt(key.substring(1));
        if (numericId >= parseInt(nextId.substring(1))) {
            nextId = "B" + ("000" + (numericId + 1)).slice(-3);
        }
    });

    // Set the generated next Bus ID to the input field
    const busIdInput = document.getElementById("BusID");
    busIdInput.value = nextId;
    busIdInput.readOnly = true; // Make the input field readonly
    busIdInput.style.pointerEvents = "none";
});
