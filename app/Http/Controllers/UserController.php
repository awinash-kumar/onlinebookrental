<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidation;
use App\Http\Requests\RequestValidations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request){
      $search = $request->search ?? "";
      if($search !=''){
        $custmor = User::where('role_id',2)->where('delete_status',0)->where('name','LIKE',"%$search%");
      }
      if($search !=''){
        $custmor = User::where('role_id',2)->where('delete_status',0)->where('email','LIKE',"%$search%")->paginate(10);
      }else{ 
        $custmor = User::where('role_id',2)->where('delete_status',0)->OrderBy('id','DESC')->paginate(10);
      }
        
      return view('custmer')->with(compact('custmor'));
    }
    
    public function create(){
      return view('add_custmer');
    }
    public function store(RequestValidation $request){
      try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'role_id' => 2,
            'delete_status'=>0,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('custmer.index')->with('success', 'User created successfully');
        } catch (Exception $e) {
            Log::info($e);
            return to_route('custmer.create')->with('error', 'Somthing went wrong!');
        }
  }

  public function edit($id){
    $custmer = User::find($id);
    if($custmer !=''){
        $data = compact('custmer');
        return view('update_custmer')->with($data); 
    }else{
        return to_route('custmer.edit');
    }
  }

  public function update($id,RequestValidations $request){
    $custmer = User::find($id);
    try{
      $custmer->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'delete_status'=>0,
            'role_id' => 2,
            // 'password' => Hash::make($request->password),
      ]);
      return redirect()->route('custmer.index')->with('success', 'User update successfully');
    } catch (Exception $e){
      return to_route('custmer.edit')->with('error', 'Somthing went wrong!');
    }
    
  }

  public function delete($id){
    $custmer = User::find($id);
    if($custmer!=''){
      User::where('id', $id)->update(['delete_status' => 1]);
        return to_route('custmer.index')->with('success', 'Deleted successfully!');
    }
  }

  public function user_delete($id){
    $custmer = User::find($id);
    if($custmer!=''){
      User::where('id', $id)->update(['delete_status' => 1]);
        // $custmer->delete();
        return to_route('dashboard')->with('success', 'Deleted successfully!');
    }
  }
  public function show($id){
    $custmer = User::find($id);
    return view('view_custmer',compact('custmer'));
  }
}