<!DOCTYPE html>
<html>

<head>
    <title>Log-in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .button-link {
            background-color: transparent;
            color: #000000;
            font-size: 16px;
            text-decoration: none;
            border: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            transition: border-bottom 0.3s;
            border-bottom: 2px solid transparent;
        }

        .button-link:hover {
            border-bottom: 2px solid #696cff;
        }

        .container-xxl {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .authentication-wrapper {
            max-width: 400px;
            background-color: rgba(157, 153, 153, 0.21);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .app-brand {
            text-align: center;
            margin-top: 3px;
        }

        .app-brand-logo {
            color: #696cff;
            font-size: 28px;
            margin-right: 10px;
        }

        .authentication-inner {
            padding: 20px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-floating input {
            padding: 1rem;
        }

        .form-floating label {
            position: absolute;
            left: 0;
            /* Posisikan label di kiri */
            top: 0;
            /* Posisikan label di atas */
            pointer-events: none;
            transition: 0.3s;
            transform-origin: top left;
            color: gray;
            /* Warna label sebelum diklik (default) */
        }

        .form-floating input:focus+label,
        .form-floating input:not(:placeholder-shown)+label {
            transform: translate(0, -125%) scale(0.85);
            /* Sesuaikan perubahan transformasi ini saat input aktif */
            opacity: 1;
            font-size: 0.9rem;
        }

        .clr2 {
            color: black;
        }

        .clr3 {
            background-color: yellow;
        }

        .clr3:hover {
            background-color: yellow;
            opacity: 0.4;
        }

        .neon-border {
            position: relative;
            padding: 10px;
        }

        .login-button {
            background-color: #000000;
            /* hitam */
            color: #32CD32;
            /* putih */
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;

            &:hover {
                transform: scale(1.1);
                box-shadow: 0 0 5px 2px #000000;
            }
        }

        .register-link {
            text-align: center;
            display: block;
            margin-top: 20px;

            &:hover {
                color: #000;
            }
        }

        .neon-border::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border: 2px solid #ff00ff;
            border-radius: 7px;
            opacity: 0;
            pointer-events: none;
            z-index: -1;
            animation: neon-animation 0.5s linear infinite alternate;
        }

        @keyframes neon-animation {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .captcha-container {
            margin-top: 20px;
        }

        .captcha-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .btn.clr3 {
            border-radius: 10px;
        }

        .btn.clr3 {
            border-radius: 10px;
        }

        .captcha-popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }



        .captcha-popup-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .captcha-image {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .captcha-popup-button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .back-to-landing-page {
            position: absolute;
            bottom: 0;
            left: 25px;
            padding: 10px;
            background-color: transparent;
            color: #000;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        .back-to-landing-page:hover {
            color: #696cff;
        }
    </style>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper neon-border authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="app-brand justify-content-center">
                    <span class="app-brand-logo demo">
                        <defs>
                            <!-- <img src="https://sms.permataharapanku.sch.id/images/logo.jpg" alt="..." width="250px"> -->
                        </defs>
                    </span>
                </div>
                <form id="formAuthentication" class="mb-3" action="<?= base_url("Home/aksi_login") ?>" method="POST">
                    <div class="mb-3 clr2">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder=" "
                                autofocus>
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle clr2">
                        <div class="form-floating">
                            <input type="password" id="password" class="form-control" name="password" placeholder=" "
                                aria-describedby="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="mb-3">
                            <!-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="staySignedIn" name="staySignedIn">
        <label class="form-check-label" for="staySignedIn">Stay Signed In</label>
    </div> -->
                        </div>
                        <div class="captcha-container">
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LcRiRYoAAAAAARi7yBzRfE3DtTwmicclw7OL6C2"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn clr3 d-grid w-100" type="submit">Log-in</button>
                        </div>
                        <div class="mt-3">
                            <a href="/home/register" class="btn btn-primary">Register</a>
                        </div>
                        <div class="mt-3">
                            <a class="nav-link" href="/"><i class="fas fa-chevron-left"></i> Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="captcha-popup" id="captchaPopup">
        <div class="captcha-popup-content">
            <div class="captcha-popup-header">Complete the Captcha</div>
            <p>For security reasons, please complete the captcha before logging in.</p>
            <button class="captcha-popup-button" id="closeCaptchaPopup">Close</button>
        </div>
    </div>

    <script>
        const inputFields = document.querySelectorAll('.form-floating input');

        inputFields.forEach(input => {
            input.addEventListener('focus', () => {
                input.nextElementSibling.classList.add('active');
            });

            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.nextElementSibling.classList.remove('active');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const captchaPopup = document.getElementById('captchaPopup');
            const closeCaptchaPopup = document.getElementById('closeCaptchaPopup');

            document.getElementById('formAuthentication').addEventListener('submit', function (event) {
                const recaptchaResponse = grecaptcha.getResponse();
                if (!recaptchaResponse) {
                    event.preventDefault();
                    captchaPopup.style.display = 'flex';
                }
            });

            closeCaptchaPopup.addEventListener('click', function () {
                captchaPopup.style.display = 'none';
            });
        });

        const passwordInput = document.getElementById('password');
        const showPasswordToggle = document.getElementById('showPasswordToggle');

        showPasswordToggle.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordToggle.innerHTML = '<i class="bx bx-show"></i>';
            } else {
                passwordInput.type = 'password';
                showPasswordToggle.innerHTML = '<i class="bx bx-hide"></i>';
            }
        });
    </script>
</body>

</html>