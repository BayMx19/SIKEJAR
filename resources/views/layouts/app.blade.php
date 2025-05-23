<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Posyandu Jambu</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/LogoPosyandu.png')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
    .floating-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
        text-decoration: none;
    }

    .floating-btn:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('layouts.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            @yield('content')
        </div>
    </div>
    <!-- Load Firebase compat 9.6.10 -->
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-messaging-compat.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", async () => {
        if (!firebase.apps.length) {
            firebase.initializeApp({
                apiKey: "AIzaSyCmrjTfjNQOxAaBDgGqJfQtXLYhIuQVutA",
                authDomain: "sikejar-posyandujambu.firebaseapp.com",
                projectId: "sikejar-posyandujambu",
                storageBucket: "sikejar-posyandujambu.firebasestorage.app",
                messagingSenderId: "72658758149",
                appId: "1:72658758149:web:c1af0cbc40018d416e8a6c",
                measurementId: "G-N9B29B3594"
            });
        }

        const messaging = firebase.messaging();

        console.log("Firebase version:", firebase.SDK_VERSION);
        console.log("Messaging object:", messaging);
        console.log("Tipe useServiceWorker:", typeof messaging.useServiceWorker);

        if ("serviceWorker" in navigator) {
            const registration = await navigator.serviceWorker.register("/firebase-messaging-sw.js");
            console.log("Service Worker registered:", registration.scope);

            const permission = await Notification.requestPermission();
            if (permission === "granted") {
                const token = await messaging.getToken({
                    vapidKey: "BCtiO2styu7pAFkLAis1O5mnCYT3Q41hQN1R4c-Qtj5CyauoSw3ua8fh5v4L3878A-IxwUCf-B322A5cJq-G1Cw",
                    serviceWorkerRegistration: registration
                });

                console.log("FCM Token:", token);

                fetch("/save-token", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                        body: JSON.stringify({
                            token
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("Token saved response:", data);
                    })
                    .catch((err) => console.error("Failed to save token:", err));
            } else {
                console.warn("User menolak notifikasi.");
            }

            messaging.onMessage((payload) => {
                console.log("[firebase-messaging] Message received in foreground:", payload);

                const {
                    title,
                    body
                } = payload.notification || {};

                if (title && body) {
                    new Notification(title, {
                        body: body,
                        icon: "/assets/images/LogoPosyandu.png",
                    });
                }
            });
        }
    });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
</body>

</html>
