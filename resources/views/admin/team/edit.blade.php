@extends('admin.layout.master')

@section('title')
    Edit Team
@endsection

@section('main-content')
     <!-- Main content -->
     <form action="/admin/team/{{ $team->id }}" method="post">
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
                                <div class="form-group @error('fullname') has-error @enderror">
                                    <label for="fullname">Fullname <span class="text text-red">*</span></label>
                                    <input type="text" name="fullname" value="{{ old('fullname',$team->fullname) }}" class="form-control" id="fullname" placeholder="Fullname">
                                    @error('fullname')
                                        <div class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation <span class="text text-red">*</span></label>
                                    <input type="text" name="designation" value="{{ old('designation',$team->designation) }}" class="form-control" id="designation" placeholder="Designation">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" name="telephone" value="{{ old('telephone',$team->telephone) }}" class="form-control" id="telephone" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" value="{{ old('mobile',$team->mobile) }}" name="mobile" class="form-control" id="mobile" placeholder="Mobile">
                                </div>
                                <div class="form-group @error('email') has-error @enderror">
                                    <label for="email">Email <span class="text text-red">*</span></label>
                                    <input type="text" name="email" value="{{ old('email',$team->email) }}" class="form-control" id="email" placeholder="Email">
                                    @error('fullname')
                                        <div class="label label-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="profile" id="profile" class="form-control" rows="5" placeholder="Enter ...">{{ old('profile',$team->profile) }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="team_img">Team Image <span class="text text-red">*</span></label>
                                    <input type="file" name="team_img" class="form-control" id="team_img" onchange="loadFile(event)">
                                    <img src="#" id="output" width="100" height="100" style="display:none;background:100% 100%;padding-top: 20px;">
                                      @error('team_img')
                                        <div class="badge alert-danger">{{ $message }}</div>
                                      @enderror
                                </div>
                                <div class="form-group">
                                    <label for="facebook_id">Facebook ID <span class="text text-red">*</span></label>
                                    <input type="text" name="facebook_id" value="{{ old('facebook_id',$team->facebook_id) }}" class="form-control" id="facebook_id" placeholder="Facebook ID">
                                </div>
                                <div class="form-group">
                                    <label for="twitter_id">Twitter ID <span class="text text-red">*</span></label>
                                    <input type="text" value="{{ old('twitter_id',$team->twitter_id) }}" name="twitter_id" class="form-control" id="twitter_id" placeholder="Twitter ID">
                                </div>
                                <div class="form-group">
                                    <label for="pinterest_id">Pinterest ID <span class="text text-red">*</span></label>
                                    <input type="text" value="{{ old('pinterest_id',$team->pinterest_id) }}" name="pinterest_id" class="form-control" id="pinterest_id" placeholder="Pinterest ID">
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