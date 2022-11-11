<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $student = Student::withTrashed()->get();        
        $student = Student::get();
        return response()->json([
            'code'=>200,
            'success'=>true,
            'message'=>'Data fetched',
            'data'=>$student
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        if($request->file('file')){
            $file = $request->file('file');
            $name = '/files/' . uniqid() . '.' . $file->extension();
             $file->storePubliclyAs('public', $name);
        }
      

        $validator = Validator::make($request->all(),[
            'name'=>'required|min:2|max:255',
            'email'=>'email|required|min:2|max:255',
            'gender'=>'required'
           
            
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code'=>400,
                'message'=>'Validasi Error',
                'errors'=>$validator->errors()
            ],400);
        }
        $inputs = $request->all();
        

    

      
        $inputs["file"]=$name;
        Student::create($inputs);
        return response()->json([
            'success'=>true,
            'code'=>200,
            'message'=>'Data Store',
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json([
            'success'=>true,
            'code'=>200,
            'message'=>'Data Founded',
            'data'=>$student
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
       
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:2|max:255',
            'email'=>'email|required|min:2|max:255',
            'gender'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code'=>'400',
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }

         $inputs=$request->all();
        if($request->file('file')){
            $file = $request->file('file');
            $name = '/files/' . uniqid() . '.' . $file->extension();
             $file->storePubliclyAs('public', $name);
             $inputs["file"]=$name;
        }

        dd($inputs);
        $student->update($inputs);
        return response()->json([
            'success'=>true,
            'code'=>200,
            'message'=>'Data Updated',
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'success'=>true,
            'code'=>200,
            'message'=>'Data Deleted',
        ]);
    }
}
