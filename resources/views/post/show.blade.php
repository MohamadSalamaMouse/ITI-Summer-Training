@extends('layouts.master')
@section('title')
    Show User
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



                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>created_at</th>
                                <th>Update_at</th>

                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td> {{$user->updated_at}}</td>

                                </tr>


                            </tbody>

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

