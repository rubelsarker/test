@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Student
                        <a class="btn btn-primary btn-sm float-right" href="{{route('student.index')}}">All Students</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{route('student.update',$row->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input value="{{$row->name}}" name="name" type="name" class="form-control" placeholder="Enter name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label><br>
                                <input accept="image/*" onchange="readURL(this);" name="image" type="file">
                                <img id="image" src="#" />
                                <img title="Old Image" src="{{URL::to($row->image)}}" style="height: 70px; width:70px ;" />
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection