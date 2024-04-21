@extends('backend.agent.app')

@section('styles')
@endsection

@section('content')

  
        <div class="container">
         <h4 class="agent-title">DASHBOARD</h4>
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{route('agent.properties.create')}}" class="btn btn-primary btn right m-b-15 addbtn">
            <i class="fa fa-plus"></i>
            New Ads
        </a>
        </div>
            </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="body">
                        <h3 class="number count-to" data-from="0" data-to="128" data-speed="2000" data-fresh-interval="700">{{ $propertytotal }}</h3>                        
                        <p class="text-muted">Property</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="body">
                        <h3 class="number count-to" data-from="0" data-to="758" data-speed="2000" data-fresh-interval="700">{{ $messagetotal }}</h3>
                        <p class="text-muted">Emails</p>
                    </div>
                </div>
            </div>        
        </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12">
                <div class="card weather2">
                    <div class="city-selected body l-parpl">
                        <div class="row">
                            <div class="info col-7">
                                <div><span>Recent Properties</span> </div>
                            </div>
                          
                        </div>
                    </div>
                    <table class="table table-striped m-b-0">
                        <tbody>
                           @foreach($properties as $key => $property)
                                      <tr>
                            <td> <a href="#" target="_blank" class="border-bottom display-block p-15  grey-text-d-2">
                                            {{ ++$key }}. {{ str_limit($property->title, 28) }}
                                            <span class="right">{{@$property->property_currency->name}} {{@$property->price }}</span>  <span class="text text-info">Viewed {{@$property->viewed}}</span>
                                        </a></td>
                         
                             </tr>   
                          @endforeach
                         
                        </tbody>
                    </table>
                                    
                </div>
            </div>
               <div class="col-lg-6 col-md-12">
                <div class="card weather2">
                    <div class="city-selected body l-parpl">
                        <div class="row">
                            <div class="info col-7">
                                <div><span>Recent Email</span> </div>
                            </div>
                          
                        </div>
                    </div>
                    <table class="table table-striped m-b-0">
                        <tbody>
                     @foreach($messages as $message)
                                      <tr>
                            <td> <a href="" class="border-bottom display-block p-15 grey-text-d-2">
                              <strong>{{ strtok($message->name, " ") }}:</strong>
                               <span class="p-l-5">{{ str_limit($message->message, 25) }}</span>
                                 </a></td>
                         
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