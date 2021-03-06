<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') System Admin @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <h1>
            System Admin
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">System Admin</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <div class="box-tools pull-right">
                            <a class="btn btn-info btn-sm" href="{{ URL::route('administrator.user_create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body margin-top-20">
                        <div class="table-responsive">
                        <table id="listDataTable" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="8%">Username</th>
                                <th width="25%">Email</th>
                                <th width="12%">Phone No.</th>
                                <th width="5%">Role</th>
                                <th width="10%">Status</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <!-- todo: have problem in mobile device -->
                                        <input class="statusChange" type="checkbox" data-pk="{{$user->id}}" @if($user->status) checked @endif data-toggle="toggle" data-on="<i class='fa fa-check-circle'></i>" data-off="<i class='fa fa-ban'></i>" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                    <td>
                                        @can('administrator.user_edit')
                                            <div class="btn-group">
                                                <a title="Edit" href="{{URL::route('administrator.user_edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                </a>
                                            </div>
                                        @endcan
                                        <!-- todo: have problem in mobile device -->
                                        @can('administrator.user_destroy')
                                            <div class="btn-group">
                                                <form  class="myAction" method="POST" action="{{URL::route('administrator.user_destroy', $user->id)}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Name</th>
                                <th width="8%">Username</th>
                                <th width="25%">Email</th>
                                <th width="12%">Phone No.</th>
                                <th width="5%">Role</th>
                                <th width="10%">Status</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            window.postUrl = '{{URL::Route("administrator.user_status", 0)}}';
            window.changeExportColumnIndex = 6;
            Generic.initCommonPageJS();
            Generic.initDeleteDialog();
        });
    </script>
@endsection
<!-- END PAGE JS-->
