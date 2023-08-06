@extends('layouts.master')
@section('title')
    Post
@endsection
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">



                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Posts</h3>
                        <a class="btn btn-primary" href="{{route('post.create')}}">Add Post</a>
                    </div>

                    @if(Session::has('delete_post'))
                        <div class="alert-success">{{Session::get('delete_post')}}</div>
                    @endif
                    @if(Session::has('msg_success'))
                    <div class="alert-success">{{Session::get('msg_success')}}</div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Image</th>
                                <th>Created_at</th>
                                <th>User_id</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->body}}</td>
                                    <td><img src="{{asset("dashboard/post/images/".$post->image)}}" width="150" length="150"></td>
                                <td>{{$post->created_at}}</td>
                                    <td> <a href="{{route('post.show',$post->user_id)}}">{{$post->user_id}}</a></td>
                                    <td>
                                        <div>
                                            <a class="btn btn-primary" href="{{route('post.edit',$post->id)}}">Edit</a>
                                            <form action="{{route('post.destroy',$post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </div>



                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Section</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('scripts')
    <!-- DataTables -->
    <script src="{{asset("dashboard/plugins/datatables/jquery.dataTables.js")}}"></script>
    <script src="{{asset("dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
