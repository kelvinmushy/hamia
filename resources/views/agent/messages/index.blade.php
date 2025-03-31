@extends('backend.agent.app')

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
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    
    .table thead th {
        background-color: #3498db;
        color: white;
        font-weight: 500;
        padding: 12px 15px;
        border: none;
    }
    
    .table tbody tr {
        background-color: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .table td {
        padding: 15px;
        vertical-align: middle;
        border-top: none;
        border-bottom: 1px solid #f1f1f1;
    }
    
    .btn-action {
        padding: 5px 10px;
        border-radius: 4px;
        margin: 0 3px;
        transition: all 0.2s;
    }
    
    .btn-view {
        background-color: #3498db;
        color: white;
    }
    
    .btn-view:hover {
        background-color: #2980b9;
    }
    
    .btn-reply {
        background-color: #2ecc71;
        color: white;
    }
    
    .btn-reply:hover {
        background-color: #27ae60;
    }
    
    .btn-delete {
        background-color: #e74c3c;
        color: white;
    }
    
    .btn-delete:hover {
        background-color: #c0392b;
    }
    
    .message-preview {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }
    
    .message-preview:hover {
        white-space: normal;
        overflow: visible;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }
    
    .page-item.active .page-link {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    .page-link {
        color: #3498db;
    }
    
    /* Status Indicators */
    .status-unread {
        background-color: #f8f9fa;
    }
    
    .status-read {
        background-color: white;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            margin-top: 15px;
        }
        
        .table td, .table th {
            padding: 8px 5px;
        }
        
        .btn-action {
            padding: 3px 5px;
            font-size: 12px;
            margin: 2px;
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
                        <h4 class="agent-title">MESSAGES</h4>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $key => $message)
                                    <tr class="{{ $message->status == 0 ? 'status-unread' : 'status-read' }}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ ucfirst(strtok($message->name,' ')) }}</td>
                                        <td><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                                        <td>
                                            <div class="message-preview" title="{{ $message->message }}">
                                                {{ Str::limit($message->message, 50) }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($message->status == 0)
                                                <a href="{{ route('agent.message.read', $message->id) }}" class="btn-action btn-view" title="Mark as read">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('agent.message.read', $message->id) }}" class="btn-action btn-view" title="Mark as unread">
                                                    <i class="fas fa-envelope-open-text"></i>
                                                </a>
                                            @endif
                                            
                                            <a href="{{ route('agent.message.replay', $message->id) }}" class="btn-action btn-reply" title="Reply">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            
                                            <button type="button" class="btn-action btn-delete" onclick="deleteMessage({{ $message->id }})" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            
                                            <form action="{{ route('agent.messages.destroy', $message->id) }}" method="POST" id="del-message-{{ $message->id }}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
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
    // Delete message confirmation
    function deleteMessage(id) {
        if(confirm('Are you sure you want to delete this message?')) {
            event.preventDefault();
            document.getElementById('del-message-' + id).submit();
        }
    }
    
    // Tooltip initialization
    $(document).ready(function() {
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover'
        });
        
        // Full message view on click
        $('.message-preview').click(function() {
            alert($(this).attr('title'));
        });
    });
</script>
@endsection