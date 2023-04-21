<h1>Welcome to Admin Login page!!</h1>

<form action="{{ route('admin_login_submit') }}" method="post">
    @csrf
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div>Password</div>
    <div><input type="password" name="password"></div>
    <div style="margin-top: 5px;"><input type="submit" value="Login"></div>
    <div style="margin-top: 5px;"></div>
</form>

