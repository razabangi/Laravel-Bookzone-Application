@extends('admin.layout.master')
@section('title')
  Add Book
@endsection

@section('main-content')
  <!-- Main content -->
  <form action="/admin/book" method="post" enctype="multipart/form-data">
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
                      <label>Category <span class="text text-red">*</span></label>
                      <select class="form-control" value="{{ old('category_id') }}" name="category_id" id="category_id" style="width: 100%;">
                        <option value="none">Select Category</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->title }}</option>                 
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Author <span class="text text-red">*</span></label>
                      <select class="form-control" value="{{ old('author_id') }}" name="author_id" id="author_id" style="width: 100%;">
                        <option value="none">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->title }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="availability">Availability <span class="text text-red">*</span></label>
                      <input type="text" class="form-control" value="{{ old('availability') }}" name="availability" id="availability" placeholder="Availability">
                    </div>
                    <div class="form-group">
                  <label for="price">Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{ old('price') }}" name="price" id="price" placeholder="Price">
                 </div>
                  <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" value="{{ old('publisher') }}" name="publisher" id="publisher" placeholder="Publisher">
                  </div>
                  <div class="form-group">
                    <label>Country of Publisher <span class="text text-red">*</span></label>
                    <select class="form-control select2" value="{{ old('country_of_publisher') }}" name="country_of_publisher" id="country_of_publisher" style="width: 100%;">
                      <option value="none">Select Country</option>
                      @foreach($countries as $country)
                          <option value="{{ $country->id }}">{{ $country->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" value="{{ old('isbn') }}" name="isbn" id="isbn" placeholder="ISBN">
                  </div>

                    <div class="form-group">
                      <label for="isbn_10">ISBN-10</label>
                      <input type="text" class="form-control" value="{{ old('isbn_10') }}" name="isbn_10" id="isbn_10" placeholder="ISBN-10">
                    </div>
                </div>
                 
                <div class="col-xs-6">
                    <div class="form-group @error('book_img') has-error @enderror">
                      <label for="book_img">Book Image</label>
                      <input type="file" class="form-control" name="book_img" id="book_img" onchange="loadFile(event)">
                      <small class="label label-warning">Cover Photo will be uploaded</small>
                      <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                      @error('book_img')
                        <div class="badge alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="book_upload">Book Upload</label>
                      <input type="file" class="form-control" name="book_upload" id="book_upload" >
                      <small class="label label-warning">Book (PDF) will be uploaded </small>
                    </div>
                  <div class="form-group">
                      <label for="audience">Audience</label>
                      <input type="text" class="form-control" value="{{ old('audience') }}" name="audience" id="audience" placeholder="Audience">
                    </div>

                    <div class="form-group">
                      <label for="format">Format</label>
                      <input type="text" class="form-control" value="{{ old('format') }}" name="format" id="format" placeholder="Format">
                    </div>

                    <div class="form-group">
                      <label for="language">Language</label>
                      <input type="text" class="form-control" value="{{ old('language') }}" name="language" id="language" placeholder="Language">
                    </div>
                    <div class="form-group">
                      <label for="total_pages">Total Pages</label>
                      <input type="text" class="form-control" value="{{ old('total_pages') }}" name="total_pages" id="total_pages" placeholder="Total Pages">
                    </div>
                    <div class="form-group">
                      <label for="edition_number">Edition Number</label>
                      <input type="text" class="form-control" value="{{ old('edition_number') }}" name="edition_number" id="edition_number" placeholder="Edition Number">
                    </div>

                    <div class="form-group">
                      <label>Recomended</label>
                      <select class="form-control" name="recommended" value="{{ old('recommended') }}" id="recommended" style="width: 100%;">
                        <option value="none">-- Select Recomended --</option>
                        <option value="yes">Recomended</option>
                        <option value="no">Not Recomended</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="description">Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/admin/book" type="reset" class="btn btn-danger">Cancel</a>
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