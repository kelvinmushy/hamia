@extends('frontend.layouts.app')

@section('top')
<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.sidebar-item a{
    color:#000;
}
.sidebar-item a:hover {
  color:#22bb33;
}
</style>
@endsection

@section('content')

        <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
             <div class="col-md-8">
                    <div class="card">
                     <div class="card card-body">
                    <h4 class="agent-title">READ MESSAGES</h4>
                    
                    <div class="agent-content">
                        
                        <span><strong>From:</strong> <em>{{ $message->name }} < {{ $message->email }} ></em></span> <br>
                        <span><strong>Phone:</strong> {{ $message->phone }}</span>

                        <div class="read-message">
                            <span>Message:</span>
                            <p>{!! $message->message !!}</p>
                        </div>

                        <a href="{{route('agent.message.replay',$message->id)}}" class="btn btn-small indigo waves-effect">
                            <i class="material-icons left">replay</i>
                            <span>Replay</span>
                        </a>

                        <form class="right" action="{{route('agent.message.readunread')}}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $message->status }}">
                            <input type="hidden" name="messageid" value="{{ $message->id }}">

                            <button type="submit" class="btn btn-small orange waves-effect">
                                <i class="material-icons left">local_library</i>
                                @if($message->status)
                                    <span>Unread</span>
                                @else 
                                    <span>Read</span>
                                @endif
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
   </div>

@endsection

@section('scripts')

@endsection