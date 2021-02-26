@extends('layout')

@section('content')
<div class="container">
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

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
