@if($errors->count() != 0 )

@foreach ($errors->all() as $error)
                  <p class="alert alert-danger">{{ $error }}</p>
 @endforeach

 @endif