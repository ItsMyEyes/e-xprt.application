importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyAFP5GcuNQOwHvCmDAmVFDV_mUj66GTXtQ",
    authDomain: "bacot-3a5f1.firebaseapp.com",
    projectId: "bacot-3a5f1",
    storageBucket: "bacot-3a5f1.appspot.com",
    messagingSenderId: "655952946229",
    appId: "1:655952946229:web:d8842593ac4004b90c3d7c",
    measurementId: "G-8SRKFBS7G0"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});