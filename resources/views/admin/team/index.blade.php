@extends('admin.layout.master')

@section('title')
    Team
@endsection

@section('main-content')
     <!-- Main content -->
            <section class="content">
                <!-- /.row -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                            <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
                            <a href="/admin/team/create" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
                        </h3>
                        <div class="box-tools">
                            <form method="get">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead style="background-color: #F8F8F8;">
                                <tr>
                                    <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                                    <th width="10%">S.No</th>
                                    <th width="20%">Fullname</th>
                                    <th width="20%">Designation</th>
                                    <th width="20%">Team Image</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Manage</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            @forelse($teams as $team)
                            <tr>
                                <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $team->fullname }}</td>
                                <td>{{ $team->designation }}</td>
                                <td>
                                    @if($team->team_img == 'No image found')
                                        <img src="/assets/admin/dist/img/No-image-found.jpg" height="90" width="90" alt="">
                                    @else
                                        <img src="/uploads/team/{{ $team->team_img }}" height="90" width="90" alt="{{ $team->fullname }}">
                                    @endif
                                </td>
                                <td>
                                    <form action="/admin/team/{{ $team->id }}/status" method="post">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        @if($team->status == 'DEACTIVE')
                                        <button class="btn btn-danger btn-sm singleStatus"><i class="fa fa-thumbs-down"></i></button>
                                        @else
                                        <button class="btn btn-info btn-sm singleStatus"><i class="fa fa-thumbs-up"></i></button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/team/{{ $team->id }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                    <a href="/admin/team/{{ $team->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-flat btn-sm singleDelete"> <i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <div class="alert alert-danger">No Record Found!</div>
                            @endforelse
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                    Showing 100 to 500 of 1000 entries</span>
                            </div>
                            <div class="col-sm-6 text-right">
                                {{ $teams->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('body').on('click','.singleStatus',function(event){
        event.preventDefault();

        var self = $(this);
        var url = self.closest('form').attr('action');

        $.ajax({
          url:url,
          type:'PUT'
        })
        .done(function(data){
          if (data == 'ACTIVE') {
            self.removeClass('btn-danger');
            self.addClass('btn-info');
            self.html('<i class="fa fa-thumbs-up"></i>');
          }
          else
          {
            self.removeClass('btn-info');
            self.addClass('btn-danger');
            self.html('<i class="fa fa-thumbs-down"></i>');
          }
        })
        .fail(function(error){
          console.log(error);
        })
        .always(function(){

        });

      });

      $('body').on('click','.singleDelete',function(event){
        event.preventDefault();

        if (confirm('Are you sure, You wanna delete it?')) 
        {
          var self = $(this);
          var url = self.closest('form').attr('action');

          $.ajax({
            url:url,
            type:'delete'
          })
          .done(function(data){
            if (data = 'deleted') 
            {
              self.closest('tr').css('background-color','red').fadeOut('slow');
              self.remove();
            }
          })
          .fail(function(error){
            console.log(error);
          })
          .always(function(){

          });
        }        

      });

    });
  </script>
@endsection