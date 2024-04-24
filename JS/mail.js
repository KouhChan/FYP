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
var contactFormDB = firebase.database().ref("Bus");

//get form from HTML
document.getElementById("Bus").addEventListener("submit", submitForm);

function submitForm(e) {
    e.preventDefault();

    var BusID = getElementVal('BusID');
    var PlatNo = getElementVal('busPlat');
    var PersonIncharge = getElementVal('personIncharge');
    var Date = getElementVal('dateCreated');

    saveMessage(BusID, PersonIncharge, Date, PlatNo);
};

const saveMessage = (BusID, PersonIncharge, Date, PlatNo) => {
    var newBus = contactFormDB.push();

    newBus.set({
        BusID: BusID,
        Date: Date,
        PersonIncharge: PersonIncharge,
        PlatNo: PlatNo,
    });
};

const getElementVal = (id) => {
    return document.getElementById(id).value;
};