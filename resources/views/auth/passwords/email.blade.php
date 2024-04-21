@extends('frontend.layouts.app')

@section('content')

    <div class="row" style="margin-top:105px;">
           <div class="col-md-4">
           </div>
        <div class="col-md-4">
            <div class="card">
                <h4 class="text text-center">{{ __('Reset Password') }}</h4>

                <div class="p-20">
                    @if (session('status'))
                        <div class="text text-info">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required class="form-control">

                                @if ($errors->has('email'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
           </div>
    </div>

@endsection
