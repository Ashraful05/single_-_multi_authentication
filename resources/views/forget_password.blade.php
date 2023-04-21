@include('nav')
<h1>Welcome to Forgot Password page!!</h1>
<form action="{{ route('submit_forget_password') }}" method="post">
    @csrf
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div style="margin-top: 5px;margin-bottom: 5px;">
        <input type="submit" value="Reset Password">
    </div>
    <div><a href="{{ route('login') }}">Back to Login</a></div>
</form>
