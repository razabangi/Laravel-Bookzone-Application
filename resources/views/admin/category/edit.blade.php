@extends('admin.layout.master')

@section('title')
  Edit Category
@endsection

@section('main-content')
   <!-- Main content -->
   <form action="/admin/category/{{ $category->id }}" method="post">
    @csrf
    {{ method_field('put') }}
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
                      <input type="text" name="title" value="{{ old('title',$category->title) }}" class="form-control" id="title" placeholder="Title">
                      @error('title')
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group @error('slug') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" value="{{ old('slug',$category->slug) }}" name="slug" class="form-control" id="slug" placeholder="Slug">
                      @error('slug')
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description', $category->description) }}</textarea>
                  </div>
                </div>
            </div>
              <!-- row end -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/admin/category" type="reset" class="btn btn-danger">Cancel</a>
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