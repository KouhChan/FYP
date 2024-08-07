const firebaseConfig = {
    apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
    authDomain: "university-bus-system.firebaseapp.com",
    databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "university-bus-system",
    storageBucket: "university-bus-system.appspot.com",
    messagingSenderId: "446380655695",
    appId: "1:446380655695:web:ee019fad4684435252163a"
};

//initialize the firebase
firebase.initializeApp(firebaseConfig);

// reference to database
var contactFormDB = firebase.database().ref("Report");

//get form from HTML
document.getElementById("report").addEventListener("submit", function(e){
    e.preventDefault();

    var confirmed = window.confirm("Are you sure you want to  submit this report?");
    if(confirmed){
        console.log("User submitted");
    var nama = getElementVal('name');
    var id = getElementVal('SId');
    var location = getElementVal('location');
    var Date = getElementVal('Date');
    var description = getElementVal('desc');

    saveMessage(nama, id, location, Date, description);
    alert("Your report has been submitted");

    document.getElementById("report").reset();
}else{
    console.log("User cancelled report");
    alert("Report submission cancelled.");
    return;
}

});



const saveMessage = (nama, id, location, Date, description) => {
    var newReport = contactFormDB.child(id);
    console.log("Saving data to report database...");
    newReport.set({
        nama: nama,
        ID: id,
        Location: location,
        Date: Date,
        Report: description,
    }).then(() => {
        console.log("Message saved successfully.");
    }).catch((error) => {
        console.error("Error saving message: ", error);
    });
};

const getElementVal = (id) => {
    return document.getElementById(id).value;
};