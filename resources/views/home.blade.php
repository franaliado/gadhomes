@extends('layout')

@section('content')
<div class="container">
  <h2>Welcome</h2>
      <div class="row justify-content-center">
        <img src="/images/logos/GAD_Logo3.png" alt="logo" width="40%" height="40%"/>
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
<h4>Please use the navigation links on the left to use the site.</h4>
</div>
@endsection
