@extends("back.layout.auth-layout")
@section('pagetitle',isset($pagetitle)?$pagetitle:"User Auth")
@section("content")
<form action="">
    <h2 class="text-center">Login Here</h2>
    <div class="form-group">
        <label for="">Username:</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Email:</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit"  name="login" class="form-control btn btn-info">
    </div>
</form>
@endsection