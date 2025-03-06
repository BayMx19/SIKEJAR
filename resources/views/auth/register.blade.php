@section('title', 'Login')
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <title>SIKEJAR</title>
    <link rel="icon" href="assets/images/LogoPosyandu.png">

    <style>
    ::-webkit-scrollbar {
        width: 8px;
        background-color: transparent !important;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #5B913B !important;
        border-radius: 5px;
    }




    .main {
        font-family: "Nunito" !important;
        scroll-behavior: smooth !important;
        background: white !important;
        width: auto;
        height: 100vh;
    }

    a {
        color: #5B913B;
        overflow: hidden;
        text-decoration: none;
    }

    label {
        float: left !important;
        font-weight: bold;
    }

    .row {
        text-align: center !important;
        justify-content: center !important;

    }

    .card {
        width: 450px !important;
        height: 500px !important;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 16px;
    }

    .card-body {
        padding: 0px 40px !important
    }


    .btn-login {
        color: white;
        font-weight: bold;
        background-color: #5B913B;
        border-radius: 10px;
        border: 2px solid transparent;
        padding: 7px 0px !important;
        margin-top: 1rem;
        display: flex;
        align-items: center !important;
        text-align: center !important;
        justify-content: center !important;
    }

    #spinner {
        margin-left: 5px;
    }

    .btn-login:hover {
        color: #5B913B;
        background-color: white;
        border: 2px solid #5B913B;
        /* height: 40px; */

    }

    .img-header {
        height: 500px;
        width: auto;
        position: absolute;
        top: 15%;
        left: 20%;
        right: 25%
    }

    .login-form {
        position: relative;
        top: 35%;
        animation: form 10s;
    }

    .form-control {
        border-radius: 10px !important;
        border: 1px solid #5B913B;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-size: 14px;
    }

    form {
        margin-top: 60px;
    }

    .login-header-img {
        margin-top: 50px;
    }

    label {
        color: #5B913B !important;
    }

    @keyframes form {
        from {
            top: 0px;
        }

        to {
            bottom: 25%;
        }
    }

    .footer-text {
        font-family: "Nunito", sans-serif !important;
        font-size: 12px !important;
        font-weight: bold;
    }

    .kiri {
        background: #5B913B !important;
        height: 100vh;
        position: relative;

    }

    .kanan {
        background: white !important;
        position: relative;
        height: 100vh;
        /* text-align: center !important;
            justify-content: center; */

    }

    .text-header {
        font-family: "Roboto", sans-serif !important;
        font-weight: bold;
        margin-top: 5%;
        font-size: 28px;

    }


    .container {
        margin-top: 5%;
    }

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 20px;
        top: 57%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .text-bawah {
        text-align: left !important;
        margin-top: 15px;
        margin-bottom: 0px !important;
    }

    .link-text-bawah {
        font-weight: bold;
    }
    </style>

</head>

<body>
    <main class="main">
        <div class="container-fluid">
            <div class="row">


                <div class="col-sm-6 kiri">
                    <img src="\assets\images\left_img_login.png" class="img-header mb-5">
                </div>
                <div class="col-sm-6 kanan">

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="header-login">
                                <h3 class="text-header">Daftar Akun</h3>
                            </div>
                            <div class="container ">
                                <div class="row login-form">
                                    <form class="mt-2" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Username -->
                                                <label for="username" class="label-form mb-1">Username</label>
                                                <input type="text" class="form-control form-login mt-2" id="username"
                                                    placeholder="Masukkan Username" name="username" required
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- Nama -->
                                                <label for="nama" class="label-form  mb-1">Nama Lengkap</label>
                                                <input type="text" class="form-control form-login mt-2" id="nama"
                                                    placeholder="Masukkan Nama Lengkap" name="nama" required
                                                    autocomplete="off">

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- Email -->
                                                <label for="email" class="label-form mt-3 mb-1">Email</label>
                                                <input type="email" class="form-control form-login mt-2" id="email"
                                                    placeholder="Masukkan Email" name="email" required
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- NIK -->
                                                <label for="NIK" class="label-form mt-3 mb-1">NIK</label>
                                                <input type="text" class="form-control form-login mt-2" id="NIK"
                                                    placeholder="Masukkan NIK" name="NIK" required autocomplete="off"
                                                    pattern="\d{16}" title="NIK harus terdiri dari 16 angka">

                                            </div>

                                        </div>



                                        <!-- Password -->
                                        <label for="password" class="label-form mt-3 mb-1">Password</label>
                                        <input type="password" class="form-control form-login mt-2" id="password"
                                            placeholder="Masukkan Password" name="password" required autocomplete="off"
                                            minlength="6">

                                        <!-- Confirm Password -->
                                        <label for="password-confirm" class="label-form mt-3 mb-1">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control form-login mt-2"
                                            id="password-confirm" placeholder="Masukkan Ulang Password"
                                            name="password_confirmation" required autocomplete="off" minlength="6">

                                        <!-- Role (Hidden) -->
                                        <input type="hidden" name="role" value="User">

                                        <h6 class="text-bawah">
                                            Sudah punya akun? <a href="/login" class="link-text-bawah">Masuk disini</a>
                                        </h6>

                                        <div class="d-grid">
                                            <button id="registerBtn" type="submit" class="btn-login">
                                                Daftar
                                                <div id="spinner" style="display: none;">
                                                    <div class="spinner-border spinner-masuk"
                                                        style="width: 1rem; height: 1rem;" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
    </script>

</body>






</html>
