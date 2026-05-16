<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if ($errors->any())
    <div style="color:red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <input
        type="email"
        name="email"
        placeholder="Email"
        value="{{ old('email') }}"
    >
    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Password"
    >
    <br><br>

    <button type="submit">
        Login
    </button>
</form>

<br>

<a href="{{ route('register') }}">
    Register
</a>

</body>
</html>