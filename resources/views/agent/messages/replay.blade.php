@extends('frontend.layouts.app')

@section('top')
<style>
    /* Modern Dashboard Styling */
    .agent-dashboard {
        background-color: #f8f9fa;
        min-height: 100vh;
    }
    
    .agent-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eaeaea;
    }
    
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: none;
    }
    
    .card-body {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-control {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        height: auto;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 15px;
        color: #7f8c8d;
    }
    
    .input-icon input,
    .input-icon textarea {
        padding-left: 40px;
    }
    
    .btn-send {
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-send:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
    }
    
    .btn-send i {
        margin-left: 5px;
    }
    
    /* Character counter */
    .char-counter {
        font-size: 12px;
        color: #7f8c8d;
        text-align: right;
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
                        <h4 class="agent-title">REPLY MESSAGE</h4>
                        
                        <div class="agent-content">
                            @if($message->user_id)
                                <form action="{{route('agent.message.send')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="agent_id" value="{{ $message->user_id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group input-icon">
                                                <i class="fas fa-envelope"></i>
                                                <input id="email" type="email" value="{{ $message->email }}" class="form-control" readonly>
                                                <label for="email">TO</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group input-icon">
                                                <i class="fas fa-phone"></i>
                                                <input id="phone" name="phone" type="tel" class="form-control" placeholder="Enter phone number">
                                                <label for="phone">Phone (optional)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group input-icon">
                                        <i class="fas fa-edit"></i>
                                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="Type your message here"></textarea>
                                        <div class="char-counter"><span id="message-counter">0</span>/500</div>
                                    </div>

                                    <div class="text-right">
                                        <button class="btn btn-send" type="submit">
                                            <span>SEND</span>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            @else 
                                <form action="{{route('agent.message.mail')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $message->name }}">
                                    <input type="hidden" name="mailfrom" value="{{ auth()->user()->email }}">

                                    <div class="form-group input-icon">
                                        <i class="fas fa-envelope"></i>
                                        <input id="email" name="email" type="email" value="{{ $message->email }}" class="form-control" readonly>
                                        <label for="email">TO</label>
                                    </div>

                                    <div class="form-group input-icon">
                                        <i class="fas fa-heading"></i>
                                        <input id="subject" name="subject" type="text" class="form-control" placeholder="Enter subject">
                                        <label for="subject">Subject</label>
                                    </div>

                                    <div class="form-group input-icon">
                                        <i class="fas fa-edit"></i>
                                        <textarea id="message-mail" name="message" class="form-control" rows="5" placeholder="Type your message here"></textarea>
                                        <div class="char-counter"><span id="mail-counter">0</span>/500</div>
                                    </div>

                                    <div class="text-right">
                                        <button class="btn btn-send" type="submit">
                                            <span>SEND</span>
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Character counter for message textarea
        $('#message').on('input', function() {
            const count = $(this).val().length;
            $('#message-counter').text(count);
        });
        
        // Character counter for mail textarea
        $('#message-mail').on('input', function() {
            const count = $(this).val().length;
            $('#mail-counter').text(count);
        });
        
        // Initialize counters on page load
        $('#message').trigger('input');
        $('#message-mail').trigger('input');
        
        // Phone number formatting
        $('#phone').on('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });
    });
</script>
@endsection