<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class StudentController extends Controller
{

    public function index()
    {
        $rows = Student::all();
        return view('admin.student.index',compact('rows'));
    }


    public function create()
    {
        return view('admin.student.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $upload_path='upload/student';
            $image_url=$upload_path.'/'.$imageName;
            if (! File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(150, 150)->save($upload_path.'/'.$imageName);
        }else{
        $image_url = "default.png";
    }
        $student = [
            'name' => $request->name,
            'image' => $image_url
        ];
        Student::create($student);
        return redirect()->bacK()->with('status','Student Added Successfully !');

    }


    public function show($id)
    {
        $row = Student::findOrFail($id);
        return view('admin.student.show',compact('row'));
    }


    public function edit($id)
    {
        $row = Student::findOrFail($id);
        return view('admin.student.edit',compact('row'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $row = Student::findOrFail($id);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = uniqid().'.'.$image->getClientOriginalExtension();
            $upload_path='upload/student';
            $image_url=$upload_path.'/'.$imageName;
            if (! File::exists($upload_path)) {
                File::makeDirectory($upload_path, $mode = 0777, true, true);
            }
            if(file_exists($row->image)){
                unlink($row->image);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(150, 150)->save($upload_path.'/'.$imageName);
        }else{
            $image_url = $row->image;
        }
        $student = [
            'name' => $request->name,
            'image' => $image_url
        ];
        Student::where('id',$id)->update($student);
        return redirect()->bacK()->with('status','Student Updated Successfully !');
    }

    public function destroy($id)
    {
        $row = Student::findOrFail($id);
        if(file_exists($row->image)){
            unlink($row->image);
        }
        $row->delete();
        return redirect()->route('student.index')->with('status','Student Deleted Successfully !');
    }
}
