@extends('layout')

@section('content')
<div class="container">
  <h2>Welcome to GADHOMES</h2>
  <h5>Please use the navigation links on the left to use the site.</h5>
      <div class="row justify-content-center">
        @if(session('success'))
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="alert alert-success" role="alert">
                  <p>{{ session('success') }}</p>
              </div>
            </div>
          </div>
        @endif
     </div>
</div>
@endsection
