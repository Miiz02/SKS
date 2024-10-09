<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('design/css/login.css') }}">
</head>

<body>
    <!-- TITLE -->
    <div class="title-container">
        <h2>SISTEM<br>KEHADIRAN SURAU</h2>
    </div>

    <div class="container" id="container">
        <!-- Login Form Section -->
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="title8">
                    <h1>Sign In</h1>
                </div>

                <!-- Email Address -->
                <label for="login-email" class="inp">
                    <input id="login-email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="&nbsp;">
                    <span class="label">Email</span>
                    <span class="focus-bg"></span>
                    @if($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </label>

                <!-- Password -->
                <label for="login-password" class="inp">
                    <input id="login-password" type="password" class="form-control" name="password" required placeholder="&nbsp;">
                    <span class="label">Password</span>
                    <span class="focus-bg"></span>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                    @if($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </label>

                <!-- Forgot Password Link -->
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>

                <!-- Submit Button -->
                <button type="submit">Sign In</button>
            </form>
        </div>

        <!-- Register Form Section -->
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
            
                <!-- Name -->
                <label for="name" class="inp">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="label">Name</span>
                    @if($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                </label>
            
                <!-- Email -->
                <label for="email" class="inp">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    <span class="label">Email</span>
                    @if($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </label>
            
                <!-- Password -->
                <label for="password" class="inp">
                    <input id="password" type="password" name="password" required>
                    <span class="label">Password</span>
                    @if($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </label>
            
                <!-- Password Confirmation -->
                <label for="password_confirmation" class="inp">
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                    <span class="label">Confirm Password</span>
                </label>
            
                <!-- Submit -->
                <button type="submit">Register</button>
            </form>
            
        </div>

        <!-- Overlay Section -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Already Set?</h1>
                    <p>To keep connected, please sign in with your registered identity</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome, Friend!</h1>
                    <p>Are you a new student? Click the sign-up button to register!</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Sistem Kehadiran Surau &copy; 2024</p>
    </footer>

    <!-- JavaScript for password toggle functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');

            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Get the input field by going up to the closest label and then finding the input inside it
                    const passwordInput = this.closest('label').querySelector('input');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.querySelector('i').classList.remove('fa-eye');
                        this.querySelector('i').classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        this.querySelector('i').classList.remove('fa-eye-slash');
                        this.querySelector('i').classList.add('fa-eye');
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('design/js/toggle.js') }}"></script>
    <script src="{{ asset('design/js/script.js') }}"></script>
</body>

</html>
