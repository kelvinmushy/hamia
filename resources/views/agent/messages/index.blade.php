
@extends('backend.agent.app')

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
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
             <div class="col-md-8">
                    <div class="card">
                    <div class="card card-body">
                    <h4 class="agent-title">MESSAGES</h4>
                    
                    <div class="agent-content">
                        <table class="table table-response">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach( $messages as $key => $message )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>{{ ucfirst(strtok($message->name,' ')) }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$message->message}}">
                                                {{ str_limit($message->message,20) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- @if($message->status == 0)
                                                <a href="{{route('agent.message.read',$message->id)}}" class="btn btn-small orange waves-effect">
                                                    <i class="material-icons">local_library</i>
                                                </a>
                                            @else 
                                                <a href="{{route('agent.message.read',$message->id)}}" class="btn btn-small green waves-effect">
                                                    <i class="material-icons">done</i>
                                                </a>
                                            @endif
                                            <a href="{{route('agent.message.replay',$message->id)}}" class="btn btn-small indigo waves-effect">
                                                <i class="material-icons">replay</i>
                                            </a> --}}
                                            <button type="button" class="btn btn-small red waves-effect" onclick="deleteMessage({{$message->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('agent.messages.destroy',$message->id)}}" method="POST" id="del-message-{{$message->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="center">
                            {{ $messages->links() }}
                        </div>
                    </div>
                     </div>

                 </div>
                </div>

            </div>
        </div>
   </div>

@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>




@endsection
