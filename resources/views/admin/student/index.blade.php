@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Students
                        <a class="btn btn-success btn-sm float-right" href="{{route('student.create')}}">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $key => $row)
                                <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$row->name}}</td>
                                <td class="text-center">
                                    <a href="{{route('student.show',$row->id)}}" class="btn btn-info btn-sm" ><i class="far fa-eye"></i></a>
                                    <a href="{{route('student.edit',$row->id)}}" class="btn btn-primary btn-sm" ><i class="far fa-edit"></i></a>
                                    <a href="{{route('student.destroy',$row->id)}}" class="btn btn-danger btn-sm" ><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection