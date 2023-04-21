@include('nav')
<h1>Welcome to User -- Dashboard page!!</h1>
<p>Hi {{ Auth::user()->name }}</p>
