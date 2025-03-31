<!-- Login Modal -->
<div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('login') }}" id="form-login">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginModalLabel">
                        <i class="fas fa-sign-in-alt me-2"></i> Login to Your Account
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Social Login -->
                    <div class="text-center mb-4">
                        <a href="{{ url('login/google') }}" class="btn btn-danger btn-lg w-100 rounded-pill">
                            <i class="fa fa-google me-2"></i> 
                            Continue with Google
                        </a>
                    </div>
                    
                    <div class="divider d-flex align-items-center my-4">
                        <span class="text-muted mx-auto">or login with email</span>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input id="email" type="email" 
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="your@email.com" 
                                   required 
                                   autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback d-block">
                                <i class="fa fa-exclamation-circle me-1"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input id="password" type="password" 
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                   name="password" 
                                   placeholder="••••••••" 
                                   required >
                                   <button type="button"  class="input-group-text  toggle-password" style="cursor: pointer">
                                    <i class="fa fa-eye"></i>
                                </button>
                            {{-- <button class="btn  toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button> --}}
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback d-block">
                                <i class="fa fa-exclamation-circle me-1"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                            <i class="fa fa-key me-1"></i> Forgot Password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                            <i class="fa fa-sign-in-alt me-2"></i> Login
                        </button>
                    </div>
                </div>
                
                <div class="modal-footer justify-content-center bg-light">
                    <p class="mb-0">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                            <i class="fa fa-user-plus me-1"></i> Sign Up
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('modal-login'));
    
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
    
    // Clear validation errors when modal is closed
    document.getElementById('modal-login').addEventListener('hidden.bs.modal', function () {
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });
    });
    
    // Auto-focus email field when modal opens
    document.getElementById('modal-login').addEventListener('shown.bs.modal', function () {
        document.getElementById('email').focus();
    });
});
</script>