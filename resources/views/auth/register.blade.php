
@extends('frontend.layouts.app')

@section('content')

<div class="row justify-content-center mt-1">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">{{ __('Register') }}</h4>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-floating mb-3">
                        <input id="name" type="text" name="name" 
                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                               value="{{ old('name') }}" required autofocus>
                        <label for="name">{{ __('Name') }}</label>

                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <!-- Email Field -->
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email" 
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                               value="{{ old('email') }}" required>
                        <label for="email">{{ __('E-Mail Address') }}</label>

                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password" 
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>
                        <label for="password">{{ __('Password') }}</label>

                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-floating mb-3">
                        <input id="password-confirm" type="password" name="password_confirmation" 
                               class="form-control" required>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>

                    <!-- Checkbox for Agent Registration -->
                    <div class="form-check mb-3">
                        <input type="checkbox" name="agent" class="form-check-input" id="agent">
                        <label class="form-check-label" for="agent">
                            {{ __('Register as an Agent') }}
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-user-plus me-2"></i> {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center">
                <p class="mb-0">Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
