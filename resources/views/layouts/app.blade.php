<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    
</head>
<body>

    <h2>My App</h2>

    <hr>

    <!-- NAVBAR -->
    <div>
        @auth
            <p>Login sebagai: {{ auth()->user()->name }}</p>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </div>

    <hr>

    <!-- MENU -->
    <div>
        @role('user')
            <a href="/dashboard">User Dashboard</a>
        @endrole

        @role('admin')
            <a href="/admin">Admin Dashboard</a>
        @endrole

        @role('super_admin')
            <a href="/super-admin">Super Admin</a>
        @endrole
    </div>

    <hr>

    <!-- CONTENT -->
    <div>
        @yield('content')
    </div>

</body>
</html>