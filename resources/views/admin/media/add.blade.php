@extends('admin.layout.master')
@section('title')
  Add Media
@endsection

@section('main-content')
  <!-- Main content -->
  <form action="/admin/media" method="post" enctype="multipart/form-data">
    @csrf
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row"> 
                <div class="col-xs-6">
                  
                  <div class="form-group @error('title') has-error @enderror">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Title">
                      @error('title')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
 
                    <div class="form-group @error('title') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug" placeholder="Slug">
                      @error('slug')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Media Type <span class="text text-red">*</span></label>
                      <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
                        <option value="none">Select Media Type</option>
                        <option value="slider">Slider</option>
                        <option value="gallery">Gallery</option>
                      </select>
                    </div>
                  </div>
                 
                <div class="col-xs-6">
                   <div class="form-group">
                      <label for="media_img">Media Image <span class="text text-red">*</span></label>
                      <input type="file" name="media_img" class="form-control" id="media_img" onchange="loadFile(event)">
                      <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description') }}</textarea>
                     </div>
                  </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
          </div>
      </div>
      <!-- /.box -->

      <!-- form end -->

    </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

<script>
    $(document).ready(function(){

        $('#title').keyup(function(){
          $('#slug').val($('#title').val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/\s]+/g, '-').toLowerCase());
        });

    });
</script>