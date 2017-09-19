@extends('master-material')
@section('name', 'Login')

@section('content')
    <div class="container col-md-4 col-md-offset-4">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                 {!! csrf_field() !!}

                <fieldset>
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password">
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="checkbox">
                    <!-- The name of the checkbox should be remember.
                    Laravel also provides the remember me functionality out of the box. We can implement it by simply creating a remember checkbox.-->
                        <label class=" col-md-offset-2"> 
                            <input type="checkbox" name="remember" > Remember Me?
                        </label>
                        
                    </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-10 col-lg-offset-1">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection