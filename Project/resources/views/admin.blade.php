<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Admin Page</title>
  </head>
  <body>

  <div class="container">
  @if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

 <a href="{{ route('showusers') }}"><button type="button" class="btn btn-success float-right mt-2 mr-3">View User</button></a>
  <br/>
<form method="post" action="{{ route('userrole.store') }}">
@csrf
 <div class="form-group">
    <label for="Name">Name</label>
    <input type="text" class="form-control" name="username"  placeholder="Enter Name">
    @error('name')
    <label class="text-danger">{{ $message }}</label>
    @enderror
  </div>
  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" class="form-control" name="email"  placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
     @error('email')
    <label class="text-danger">{{ $message }}</label>
    @enderror
  </div>

   <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" class="form-control" name="password"  placeholder="Enter Password">
    @error('password')
    <label class="text-danger">{{ $message }}</label>
    @enderror
  </div>

  <div class="form-group">
    <label for="Role">Role</label>
    <select class="custom-select" name="roles" >
    <option value="0" selected disabled>Select Role</option>
     @foreach($roles as $role)
  <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach
</select>
   @error('roles')
    <label class="text-danger">{{ $message }}</label>
    @enderror
  </div>


  {{-- <div class="form-check">
   <strong>Roles: </strong>
    <label class="form-check-label ml-3" for="role">Owner</label>
      <input type="checkbox" class="form-check-input ml-1 mt-2" id="owner" name="owner">

          <label class="form-check-label ml-4" for="role">Editor</label>
      <input type="checkbox" class="form-check-input ml-1 mt-2" id="owner" name="owner">

          <label class="form-check-label ml-4" for="role">Viewer</label>
      <input type="checkbox" class="form-check-input ml-1 mt-2" id="owner" name="owner">
      @error('role')
    <label class="text-danger">{{ $message }}</label>
    @enderror
  </div> --}}
  <div>
  <strong>Google Recaptcha: </strong>
  {!! NoCaptcha::renderJs() !!}
  {!! NoCaptcha::display() !!}
  </div>

  <button type="submit" value="submit" class="btn btn-primary">Submit</button>

</form>

</div>
 {{-- <div class="ml-4 mt-4">
<a href="{{ route('login') }}"><button class="btn btn-danger">Google Sign In</button></a> 
   </div> --}}


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>




