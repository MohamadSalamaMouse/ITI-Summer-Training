@extends('layouts.master')
@section('title')
   Create Post
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-primary">
                        @if(Session::has('msg_success'))
                            <div class="alert-success">
                                {{Session::get('msg_success')}}
                            </div>
                        @endif
                            @if(Session::has('msg_error'))
                                <div class="alert-danger">
                                    {{Session::get('msg_error')}}
                                </div>
                            @endif
                        <div class="card-header">
                            <h3 class="card-title">Add Post</h3>

                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Title</label>
                                    <input type="text" class="form-control"  name="title" id="exampleInputEmail1"  >
                                </div>
                                @if($errors->has('title'))
                                    <div  style="color: red">{{ $errors->first('title') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Body</label>
                                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                                </div>
                                @if($errors->has('body'))

                                    <div style="color: red">{{ $errors->first('body') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Image</label>
                                    <input type="file" class="form-control"  name="image" id="exampleInputEmail1"  >
                                </div>
                                @if($errors->has('image'))
                                    <div  style="color: red">{{ $errors->first('image') }}</div>
                                @endif

{{--                                <div class="form-group">--}}
{{--                                    <label for="exampleInputEmail1">Created by</label>--}}
{{--                                   <select name="user_id" class="form-control">--}}
{{--                                       @foreach($users as $user)--}}
{{--                                       <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                                       @endforeach--}}
{{--                                   </select>--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                    <!-- Form Element sizes -->


                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

