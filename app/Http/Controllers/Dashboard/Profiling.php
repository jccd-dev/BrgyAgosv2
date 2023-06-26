<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Profiling extends Controller
{
    //initialize validation rules
    protected array $rules = [
        'fname'     => 'required|alpha',
        'mname'     => 'required|alpha',
        'lname'     => 'required|alpha',
        'suffix'    => 'nullable|max:2|alpha',
        'bod'       => 'required|date_format:m/d/Y',
        'age'       => 'required|numeric|digits:3|max:150',
        'sex'       => 'required|alpha',
        'cstatus'   => 'required|alpha',
        'zone'      => 'required|numeric|digits:1',
        'bplace'    => 'required|regex:/^[a-zA-Z0-9.]+$/',
        'cpnumber'  => 'nullable|regex:/^09\d{9}$/',
        'email'     => 'nullable|email',
        'pwd'       => 'nullable',
        'senior'    => 'nullable'
    ];

    protected array $message = [
        'bod.required'    => 'Birthday is required',
        'bod.date_format' => 'Invalid date format'
    ];

    public function render(){
        return view('dashboard.profiling');
    }

    public function add_profile(Request $request){

        $validator = Validator::make($request->all(), $this->rules, $this->message);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }


    }
}
