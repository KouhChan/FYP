<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <script src="https://www.gstatic.com/firebasejs/9.6.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.4/firebase-database.js"></script>
</head>

<body>
    <h1>Report Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody id="reportData">
            <!-- Data will be dynamically added here -->
        </tbody>
    </table>

    <script>
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
        const db = firebase.database();
        const dbRef = db.ref("Report");

        // Function to populate the table with data from Firebase
        function populateTable(data) {
            const tbody = document.getElementById("reportData");
            tbody.innerHTML = ""; // Clear existing table content

            data.forEach(item => {
                const {
                    nama,
                    ID,
                    Location,
                    Date,
                    Report
                } = item;
                const row = `
                    <tr>
                        <td>${nama}</td>
                        <td>${ID}</td>
                        <td>${Location}</td>
                        <td>${Date}</td>
                        <td>${Report}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Fetch data from Firebase and populate the table once when the page loads
        window.onload = function() {
            dbRef.on("value", snapshot => {
                const data = [];
                snapshot.forEach(childSnapshot => {
                    data.push(childSnapshot.val());
                });
                populateTable(data);
            });
        };
    </script>
</body>

</html>