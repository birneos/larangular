@extends('master-material');
@section('name','Register');

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                <!-- instead  <input type="hidden" name="_token" value="{!! csrf_token() !!}"> -->
                <!-- You can can use followed helper function -->
                 {!! csrf_field() !!}

                <fieldset>
                    <legend>Register an account</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <!-- old()  When the form's validation fails, the users will be redirected back to the form, old users input will displayed -->
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Confirm password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection