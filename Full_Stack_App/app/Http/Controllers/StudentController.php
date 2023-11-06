<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    

    public function index(Request $request){

        return response()->json(Student::all(),200);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'course'=>'required|max:191',
            'phone'=>'required|min:4|max:12',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else{
            $students = Student::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'course'=>$request->course,
            ]);

            if($students){

                return response()->json([
                    'status'=>200,
                    'message'=>'Student added successfully'
                ],200);
            }else{

                return response()->json([
                    'status'=>500,
                    'message'=>'Student is failed'
                ],500);
            }
        }


    }

    public function edit($id){
        $s = Student::find($id);
        if($s){
            return response()->json([
                'status'=>200,
                'student'=>$s
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'no student found'
            ],404);
        }
    }

 public function update(Request $request,$id){

    $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'email'=>'required|email|max:191',
            'course'=>'required|max:191',
            'phone'=>'required|min:4|max:12',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else{

            $student = Student::find($id);
            if($student){
                $student->name=$request->name;
                $student->email=$request->email;
                $student->phone=$request->phone;
                $student->course=$request->course;
                $student->update();
        

                return response()->json([
                    'status'=>200,
                    'message'=>'Student added successfully'
                ],200);
            }else{

                return response()->json([
                    'status'=>500,
                    'message'=>'Student is failed'
                ],500);
            }
        }

 }

 public function delete(Request $request,$id){

    $s = Student::find($id);
    if(is_null($s)){
        return response()->json(['message'=>'Student NOt found'],404);
    }
    $s->delete();
    return response(null,204);
     }
}
