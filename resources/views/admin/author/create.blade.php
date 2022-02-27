@extends('admin.layout.master')
@section('title')
  Create Author
@endsection
@section('main-content')
   <!-- Main content -->
   <form action="/admin/author" method="post" enctype="multipart/form-data" id="formAdd">
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
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
 
                    <div class="form-group @error('slug') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug" placeholder="Slug">
                      @error('slug')
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="designation">Designation <span class="text text-red">*</span></label>
                      <input type="text" name="designation" value="{{ old('designation') }}" class="form-control" id="designation" placeholder="Designation">
                    </div>
                    <div class="form-group">
                  <label for="dob">Date of birth: <span class="text text-red">*</span></label> 
                  <input type="date" name="dob" value="{{ old('dob') }}" class="form-control" id="dob" placeholder="Date of Birth">
                 </div>
 
                    <div class="form-group">
                      <label for="email">Email <span class="text text-red">*</span></label>
                      <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label>Country <span class="text text-red">*</span></label>
                      <select name="country" id="country" class="form-control select2" style="width: 100%;">                        
                        <option value="none">Select Country</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>                        
                        @endforeach
                      </select>
                    </div>
 
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="Phone">
                    </div>
 
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ old('description') }}</textarea>
                  </div>
                </div>
                  
                <div class="col-xs-6">
                   <div class="form-group @error('author_img') has-error @enderror">
                      <label for="author_img">Author Image <span class="text text-red">*</span></label>
                      <input type="file" name="author_img" class="form-control" id="author_img" onchange="loadFile(event)">
                      <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                      @error('author_img')
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  <div class="form-group">
                      <label for="facebook_id">Facebook ID</label>
                      <input type="text" name="facebook_id" value="{{ old('facebook_id') }}" class="form-control" id="facebook_id" placeholder="Facebook ID">
                    </div>
 
                    <div class="form-group">
                      <label for="twitter_id">Twitter ID</label>
                      <input type="text" name="twitter_id" value="{{ old('twitter_id') }}" class="form-control" id="twitter_id" placeholder="Twitter ID">
                    </div>
 
                    <div class="form-group">
                      <label for="youtube_id">YouTube ID</label>
                      <input type="text" name="youtube_id" value="{{ old('youtube_id') }}" class="form-control" id="youtube_id" placeholder="YouTube ID">
                    </div>
                    <div class="form-group">
                      <label for="pinterest_id">Pinterest ID</label>
                      <input type="text" name="pinterest_id" value="{{ old('pinterest_id') }}" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
                    </div>
                    <div class="form-group">
                    <label>Author Feature</label>
                    <select name="author_feature" id="author_feature" class="form-control select2" style="width: 100%;">
                      <option value="no">NO</option>
                      <option value="yes">Yes</option>
                    </select>
                </div>
                </div>
            </div>
            
 
              <!-- row end -->
 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/admin/author" class="btn btn-danger">Cancel</a>
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

@section('scripts')
  <script>
      $(document).ready(function(){

          $('#title').keyup(function(){
            $('#slug').val($('#title').val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/\s]+/g, '-').toLowerCase());
          });

      });
  </script>
@endsection