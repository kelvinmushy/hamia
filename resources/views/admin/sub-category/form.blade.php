<div class="modal fade" id="modal-sub" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-sub" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id" id="sub_id">
                                    <label>Category</label>
                                     <select class="form-control" name="category_id" id="category_id">
                                        @foreach($category as $cat)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                     </select>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        required />
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        required />
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                        required />
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
                    </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
