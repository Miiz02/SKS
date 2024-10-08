<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swa                                                      ` p" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('design-sekas/css/loginstyle copy.css') }}">
   
</head>

<body>
    <!-- TITLE -->
    <h1>SISTEM <br>KEHADIRAN SURAU</h1>

    <div class="container">
        <!-- Image Section -->
        <div class="image-section">
            <img src="{{ asset('design-sekas/img/GIBS.png') }}" alt="GIBS Logo">
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <div class="header-section">
                <h2>LOGIN</h2>
            </div>

            <!-- Laravel Form Handling Logic -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                    <!-- Error Display for Email -->
                    @if($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <label for="password">PASSWORD</label>
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">
                    <!-- Error Display for Password -->
                    @if($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn mt-4">Sign In</button>

                <!-- Remember Me Checkbox and Forgot Password -->
                <div class="options mt-4">
                    <!-- Remember Me -->
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Remember Me</label>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Sign Up Link -->
            <div class="signup-link mt-4">
                Not a member?&nbsp;<a href="#">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>
