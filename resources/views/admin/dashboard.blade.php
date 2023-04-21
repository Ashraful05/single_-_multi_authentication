@include('admin.nav')
<h1>Welcome to Admin Dashboard page!!</h1>
<p>Hi {{ Auth::guard('admin')->user()->name }}</p>
