
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
@endsection
@section('content')

  
        <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
          

             <div class="col-md-8">
            <div class="card">
                <div class="header bg-orange">
                    <h2>Ads Lists</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Viewed</th>
                                    <th>Promote</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $properties as $key => $property )
                                <tr>
                                 <td>
                         @foreach($property->property_gallery as $key =>$g)
                           
                             @if($key==0)
                         <img  class="img-thumbnail" src="{{asset(@$g->path)}}" width="80" class="img-responsive img-rounded" />
                             @endif
                       @endforeach  
                                    </td>
                                    <td>
                                        <span title="{{$property->title}}">
                                            {{ str_limit($property->title,10) }}
                                        </span>
                                    </td>
                                     <td>{{$property->viewed}}</td>
                                     <td class="text"><i class="fa fa-bullhorn" aria-hidden="true" style="font-size:25px;color:red"></i></td>
                                      @if($property->status==0)
                                           <td class="text text-info" onclick="propertStatus({{$property->id}})"
                                        style="cursor: pointer;"
                                      ><b>close</b> </td>

                                      @else
                                           <td class="text text-danger" onclick="propertStatus({{$property->id}})"
                                        style="cursor: pointer;"
                                      ><b>closed</b></td>

                                      @endif
                                 
                                    <td class="text-center">
                                        <a href="{{route('agent.preview.property',$property->id)}}" class="btn btn-success btn-sm ">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                     
                                          <a href="{{route('agent.properties.edit',$property->id)}}" class="btn btn-info btn-sm ">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                      
                                        {{-- <button type="button" class="btn btn-danger btn-sm " onclick="deletePost({{$property->id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form action="{{route('agent.properties.destroy',@$property->id)}}" method="POST" id="del-post-{{@$property->id}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
          </div>
           
        </div>


@endsection

@section('scripts')

@endsection
  

