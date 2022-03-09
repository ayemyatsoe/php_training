<?php

namespace App\Http\Controllers\API;

use Response;
use App\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    public function index(){
        $student= Students::get();
        $response=[
            'status'=>'success',
            'data'=>$student
        ];
        return Response::json($response); 
    }
    public function create(Request $request){
        //dd($request->header("key"));
        //dd($request->all());
       
       $data = [
           'name' => $request->name,
           'email' => $request->email,
           'dob' => $request->dob,
           'phone' => $request->phone,
           'major_id'=>$request->major_id,
           'address'=>$request->address,
           'created_at'=>Carbon::now(),
           'updated_at'=>Carbon::now()
       ];
       Students::create($data);
       $response=Response::json(
           [
               'status'=>200,
               'message'=>'success'
           ]
           );
        return $response;
    }
    public function detail($id){
    //  $id=$request->id;
       // dd($request->all());
       $data=Students::where('id',$id)->first();
       if(!empty($data)){
        $response=Response::json(
            [
                'status'=>200,
                'message'=>'success',
                'data'=>$data
            ]
            );
         return $response;
       }
       else {
        $response=Response::json(
            [
                'status'=>200,
                'message'=>'fail',
                'data'=>$data
            ]
            );
         return $response;
       }
    }
    public function delete($id){ 
        $data=Students::where('id',$id)->first();
        if(empty($data)){
            $response=Response::json(
                [
                    'status'=>200,
                    'message'=>'No data',
                    'data'=>$data
                ]
                );
             return $response;
           }
        Students::where('id',$id)->delete();

        return Response::json(
            [
                'status'=>200,
                'message'=>'delete',
            ]
            );
    }
    public function update(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'major_id'=>$request->major_id,
            'address'=>$request->address,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $check=Students::where('id',$request->id)->first();
        if(!empty($check)){
            Students::where('id',$request->id)->update($data);
            return Response::json(
                [
                    'status'=>200,
                    'message'=>'update'
                ]
                );
        }
        return Response::json(
            [
                'status'=>200,
                'message'=>'no data',
            ]
            );
    }
}