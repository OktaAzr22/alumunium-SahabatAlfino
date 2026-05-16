

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

@if ($errors->any())
    <div style="color:red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <input
        type="text"
        name="name"
        placeholder="Nama"
        value="{{ old('name') }}"
    >
    <br><br>

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

    <input
        type="password"
        name="password_confirmation"
        placeholder="Konfirmasi Password"
    >
    <br><br>

    <button type="submit">
        Register
    </button>
</form>

<br>

<a href="{{ route('login') }}">
    Login
</a>

</body>
</html>