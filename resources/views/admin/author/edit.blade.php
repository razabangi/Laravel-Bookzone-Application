@extends('admin.layout.master')
@section('title')
  Edit Author
@endsection

@section('main-content')
  <!-- Main content -->
  <form action="/admin/author/{{$author->id}}" enctype="multipart/form-data" method="post">
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
                  <div class="form-group">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" value="{{ $author->title }}" class="form-control" id="title" placeholder="Title">
                    </div>
 
                    <div class="form-group">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" value="{{ $author->slug }}" class="form-control" id="slug" placeholder="Slug">
                    </div>
                    <div class="form-group">
                      <label for="designation">Designation <span class="text text-red">*</span></label>
                      <input type="text" name="designation" value="{{ $author->designation }}" class="form-control" id="designation" placeholder="Designation">
                    </div>
                    <div class="form-group">
                  <label for="dob">Date of birth: <span class="text text-red">*</span></label> 
                  <input type="date" name="dob" value="{{ $author->dob }}" class="form-control" id="dob" placeholder="Date of Birth">
                 </div>
 
                    <div class="form-group">
                      <label for="email">Email <span class="text text-red">*</span></label>
                      <input type="email" name="email" value="{{ $author->email }}" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label>Country <span class="text text-red">*</span></label>
                      <select name="country" id="country" class="form-control select2" style="width: 100%;">
                        <option value="none">Select Country</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}" {{ ($country->id == $author->country) ? 'selected' : null }}>{{ ucfirst($country->name) }}</option>                        
                        @endforeach
                      </select>
                    </div>
 
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" value="{{ $author->phone }}" class="form-control" id="phone" placeholder="Phone">
                    </div>
 
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{ $author->description }}</textarea>
                  </div>
                </div>
                  
                <div class="col-xs-6">
                   <div class="form-group">
                      <label for="author_img">Author Image <span class="text text-red">*</span></label>
                      <input type="file" name="author_img" class="form-control" id="author_img" onchange="loadFile(event)">
                      <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                    </div>
                  <div class="form-group">
                      <label for="facebook_id">Facebook ID</label>
                      <input type="text" name="facebook_id" value="{{ $author->facebook_id }}" class="form-control" id="facebook_id" placeholder="Facebook ID">
                    </div>
 
                    <div class="form-group">
                      <label for="twitter_id">Twitter ID</label>
                      <input type="text" name="twitter_id" value="{{ $author->twitter_id }}" class="form-control" id="twitter_id" placeholder="Twitter ID">
                    </div>
 
                    <div class="form-group">
                      <label for="youtube_id">YouTube ID</label>
                      <input type="text" name="youtube_id" value="{{ $author->youtube_id }}" class="form-control" id="youtube_id" placeholder="YouTube ID">
                    </div>
                    <div class="form-group">
                      <label for="pinterest_id">Pinterest ID</label>
                      <input type="text" name="pinterest_id" value="{{ $author->pinterest_id }}" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
                    </div>
                    <div class="form-group">
                    <label>Author Feature</label>
                    <select name="author_feature" id="author_feature" class="form-control select2" style="width: 100%;">
                      <option value="no" {{ ($author->author_feature == 'no') ? 'selected' : null }}>NO</option>
                      <option value="yes" {{ ($author->author_feature == 'yes') ? 'selected' : null }}>Yes</option>
                    </select>
                </div>
                </div>
            </div>
 
              <!-- row end -->
 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/admin/author" type="reset" class="btn btn-danger">Cancel</a>
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