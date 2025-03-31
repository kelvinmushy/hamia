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
    
    .message-header {
        background-color: #f1f8fe;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    
    .message-header span {
        display: block;
        margin-bottom: 5px;
    }
    
    .read-message {
        background-color: white;
        border: 1px solid #eaeaea;
        border-radius: 6px;
        padding: 20px;
        margin: 20px 0;
        line-height: 1.6;
    }
    
    .btn-action {
        padding: 8px 15px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-reply {
        background-color: #3498db;
        color: white;
    }
    
    .btn-reply:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    
    .btn-status {
        background-color: #f39c12;
        color: white;
    }
    
    .btn-status:hover {
        background-color: #e67e22;
        transform: translateY(-2px);
    }
    
    .btn-action i {
        margin-right: 5px;
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
        
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .right {
            float: none !important;
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
                        <h4 class="agent-title">MESSAGE DETAILS</h4>
                        
                        <div class="agent-content">
                            <div class="message-header">
                                <span><strong><i class="fas fa-user"></i> From:</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</span>
                                <span><strong><i class="fas fa-phone"></i> Phone:</strong> {{ $message->phone ?? 'Not provided' }}</span>
                                <span><strong><i class="fas fa-clock"></i> Received:</strong> {{ $message->created_at->format('M d, Y h:i A') }}</span>
                            </div>

                            <div class="read-message">
                                <h5><strong><i class="fas fa-envelope-open-text"></i> Message:</strong></h5>
                                <div class="message-content">
                                    {!! nl2br(e($message->message)) !!}
                                </div>
                            </div>

                            <div class="action-buttons">
                                <a href="{{route('agent.message.replay',$message->id)}}" class="btn-action btn-reply">
                                    <i class="fas fa-reply"></i>
                                    <span>Reply</span>
                                </a>

                                <form class="right" action="{{route('agent.message.readunread')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $message->status }}">
                                    <input type="hidden" name="messageid" value="{{ $message->id }}">

                                    <button type="submit" class="btn-action btn-status">
                                        <i class="fas fa-bookmark"></i>
                                        @if($message->status)
                                            <span>Mark as Unread</span>
                                        @else 
                                            <span>Mark as Read</span>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Format phone number if exists
        const phoneElement = $('.message-header span:contains("Phone:")');
        if (phoneElement.text().includes('Not provided')) return;
        
        const phoneNumber = phoneElement.text().split(':')[1].trim();
        const formattedPhone = formatPhoneNumber(phoneNumber);
        phoneElement.html(phoneElement.html().replace(phoneNumber, formattedPhone));
        
        function formatPhoneNumber(phone) {
            // Simple formatting - adjust based on your needs
            if (phone.length === 10) {
                return phone.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }
            return phone;
        }
    });
</script>
@endsection