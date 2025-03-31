@extends('backend.agent.app')

@section('top')
<style>
    /* Modern Dashboard Styling with Consistent Fonts */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
    }
    
    .agent-dashboard {
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .agent-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eaeaea;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card-body {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }
    
    label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        height: auto;
        font-size: 14px;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .btn-primary {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
    }
    
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 35px;
        cursor: pointer;
        color: #7f8c8d;
    }
    
    .password-toggle:hover {
        color: #3498db;
    }
    
    .password-strength {
        height: 5px;
        margin-top: 5px;
        border-radius: 2px;
        background-color: #eee;
        overflow: hidden;
    }
    
    .strength-meter {
        height: 100%;
        width: 0;
        transition: width 0.3s;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            margin-top: 15px;
        }
        
        .agent-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 15px;
        }
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="agent-dashboard">
    <div class="container" style="margin-top:30px;">
        <h4 class="agent-title">DASHBOARD</h4>
        <div class="row">
            @include('agent.sidebar')
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="agent-content">
                            <h4 class="agent-title">Change Password</h4>

                            <form action="{{route('agent.changepassword.update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="currentpassword">Current Password</label>
                                    <input id="currentpassword" name="currentpassword" type="password" class="form-control" required>
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('currentpassword')"></i>
                                </div>

                                <div class="form-group">
                                    <label for="newpassword">New Password</label>
                                    <input id="newpassword" name="newpassword" type="password" class="form-control" required oninput="checkPasswordStrength()">
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('newpassword')"></i>
                                    <div class="password-strength">
                                        <div class="strength-meter" id="password-strength-meter"></div>
                                    </div>
                                    <small id="password-help" class="form-text text-muted"></small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="new-password_confirmation">Confirm New Password</label>
                                    <input id="new-password_confirmation" name="newpassword_confirmation" type="password" class="form-control" required oninput="checkPasswordMatch()">
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('new-password_confirmation')"></i>
                                    <small id="password-match" class="form-text"></small>
                                </div>

                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-key"></i> Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bot')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    // Toggle password visibility
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Check password strength
    function checkPasswordStrength() {
        const password = document.getElementById('newpassword').value;
        const meter = document.getElementById('password-strength-meter');
        const helpText = document.getElementById('password-help');
        
        // Reset
        meter.style.width = '0%';
        meter.style.backgroundColor = '#eee';
        helpText.textContent = '';
        
        if (password.length === 0) return;
        
        // Check strength
        let strength = 0;
        
        // Length
        if (password.length > 7) strength += 1;
        if (password.length > 11) strength += 1;
        
        // Contains both lower and uppercase
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        
        // Contains numbers
        if (password.match(/([0-9])/)) strength += 1;
        
        // Contains special chars
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        
        // Update meter
        let width = strength * 20;
        let color = '#e74c3c'; // Red
        
        if (strength >= 3) color = '#f39c12'; // Orange
        if (strength >= 4) color = '#2ecc71'; // Green
        
        meter.style.width = width + '%';
        meter.style.backgroundColor = color;
        
        // Update help text
        if (password.length < 8) {
            helpText.textContent = 'Password should be at least 8 characters';
            helpText.style.color = '#e74c3c';
        } else if (strength < 3) {
            helpText.textContent = 'Weak password - try adding numbers or special characters';
            helpText.style.color = '#f39c12';
        } else {
            helpText.textContent = 'Strong password';
            helpText.style.color = '#2ecc71';
        }
    }
    
    // Check password match
    function checkPasswordMatch() {
        const password = document.getElementById('newpassword').value;
        const confirmPassword = document.getElementById('new-password_confirmation').value;
        const matchText = document.getElementById('password-match');
        
        if (confirmPassword.length === 0) {
            matchText.textContent = '';
            return;
        }
        
        if (password === confirmPassword) {
            matchText.textContent = 'Passwords match';
            matchText.style.color = '#2ecc71';
        } else {
            matchText.textContent = 'Passwords do not match';
            matchText.style.color = '#e74c3c';
        }
    }
    
    // Initialize password strength check on page load if there's already input
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('newpassword').value.length > 0) {
            checkPasswordStrength();
        }
        if (document.getElementById('new-password_confirmation').value.length > 0) {
            checkPasswordMatch();
        }
    });
</script>
@endsection