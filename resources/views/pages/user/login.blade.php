<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="/src/css/login.css">
</head>
<body>
  <div class="login_form">
    <h3>First, you need to login</h3>

    <!-- Display error messages -->
    @if($errors->any())
        <div class="error_messages">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf  
        <!-- Email input box -->
        <div class="input_box">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required />
        </div>

        <!-- Password input box -->
        <div class="input_box">
            <div class="password_title">
                <label for="password">Password</label>
            </div>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>

        <!-- Login button -->
        <button type="submit">Log In</button>
    </form>
  </div>
</body>
</html>