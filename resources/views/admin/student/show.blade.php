@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-secondary p-3">{{$row->name}} Profile</span>
                        <a class="btn btn-primary btn-sm float-right" href="{{route('student.index')}}">Back</a>

                    </div>

                    <div class="card-body text-center">
                        <img src="{{URL::to($row->image)}}" alt="{{$row->name}}" class="img-fluid">
                        <h1>{{$row->name}}</h1>
                        <p>{{date('d M Y',strtotime($row->created_at))}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection