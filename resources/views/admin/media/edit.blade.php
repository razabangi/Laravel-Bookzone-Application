@extends('admin.layout.master')
@section('title')
  Edit Media
@endsection

@section('main-content')
   <!-- Main content -->
   <form action="/admin/media/{{ $media->id }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row"> 
                <div class="col-xs-6">
                  
                  <div class="form-group">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" value="{{ old('title',$media->title) }}" class="form-control" id="title" placeholder="Title">
                    </div>
 
                    <div class="form-group">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" value="{{ old('slug',$media->slug) }}" class="form-control" id="slug" placeholder="Slug">
                    </div>
                    <div class="form-group">
                      <label>Media Type <span class="text text-red">*</span></label>
                      <select name="media_type" id="media_type" class="form-control" style="width: 100%;">
                        <option value="none">Select Media Type</option>
                        <option value="slider" {{ ($media->media_type == 'slider') ? 'selected' : null }}>Slider</option>
                        <option value="gallery" {{ ($media->media_type == 'gallery') ? 'selected' : null }}>Gallery</option>
                      </select>
                    </div>
                  </div>
                 
                <div class="col-xs-6">
                   <div class="form-group">
                      <label for="media_img">Media Image <span class="text text-red">*</span></label>
                      <input type="file" name="media_img" class="form-control" id="media_img" onchange="loadFile(event)">
                      <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                      @if($media->media_img != 'No image found')
                        <img src="/uploads/media/{{ $media->media_img }}" width="90" height="90" alt="">
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description',$media->description) }}</textarea>
                     </div>
                  </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
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