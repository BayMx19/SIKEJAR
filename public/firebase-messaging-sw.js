importScripts(
    "https://www.gstatic.com/firebasejs/10.7.0/firebase-app-compat.js"
);
importScripts(
    "https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging-compat.js"
);

firebase.initializeApp({
    apiKey: "AIzaSyCmrjTfjNQOxAaBDgGqJfQtXLYhIuQVutA",
    authDomain: "sikejar-posyandujambu.firebaseapp.com",
    projectId: "sikejar-posyandujambu",
    storageBucket: "sikejar-posyandujambu.firebasestorage.app",
    messagingSenderId: "72658758149",
    appId: "1:72658758149:web:c1af0cbc40018d416e8a6c",
    measurementId: "G-N9B29B3594",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: "/assets/images/LogoPosyandu.png",
    };
    console.log(
        "Showing notification:",
        notificationTitle,
        notificationOptions
    );
    self.registration
        .showNotification(notificationTitle, notificationOptions)
        .then(() => console.log("Notification shown successfully"))
        .catch((err) => console.error("Failed to show notification", err));
});
