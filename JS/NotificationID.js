// Reference to the database
const database = firebase.database();
const notificationRef = database.ref("Notification");

// Retrieve input values
const description = document.getElementById("description").value;
const admin = document.getElementById("admin").value;

// Generate next Bus ID
let nextId = "NID001";
notificationRef.once('value', function (snapshot) {
    snapshot.forEach(function (childSnapshot) {
        const key = childSnapshot.key;
        const numericId = parseInt(key.substring(3));
        if (numericId >= parseInt(nextId.substring(3))) {
            nextId = "NID" + ("000" + (numericId + 1)).slice(-3);
        }
    });

    // Set the generated next Bus ID to the input field
    const NotificationIdInput = document.getElementById("NotificationID");
    NotificationIdInput.value = nextId;
    NotificationIdInput.readOnly = true; // Make the input field readonly
    NotificationIdInput.style.pointerEvents = "none";
});
