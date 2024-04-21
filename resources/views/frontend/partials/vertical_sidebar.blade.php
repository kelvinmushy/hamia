<div class="container-fluid">
    <div class="row clearfix d-block d-md-none" style="margin-top:50px;">
         

         <div class="card">

            <div class="card card-body">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                        @foreach($subCategory as $sub)
                        <a href="/singleSubCategory/{{@$sub->id}}">{{@$sub->name}} <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                          <hr>
                          @endforeach

                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>

         </div>
           
</div>

</div>


