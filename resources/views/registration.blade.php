@include('nav')
<h1>Welcome to Registration page!!</h1>

<form action="{{ route('submit_registration') }}" method="post">
    @csrf
    <div>Name</div>
    <div><input type="text" name="name"></div>
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div>Password</div>
    <div><input type="password" name="password"></div>
    <div>Retype Password</div>
    <div><input type="password" name="retype_password"></div>
    <div style="margin-top:10px;"><input type="submit" value="Register"></div>
</form>
