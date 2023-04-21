@include('nav')
<h1>Welcome to Reset Password page!!</h1>
<form action="{{ route('reset_password_submit') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <div>New Password</div>
    <div><input type="password" name="new_password"></div>
    <div>Retype Password</div>
    <div><input type="password" name="retype_password"></div>
    <div style="margin-top: 5px;margin-bottom: 5px;">
        <input type="submit" value="Reset Password">
    </div>
    <div><a href="{{ route('login') }}">Back to Login</a></div>
</form>
