<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Dashboard\ProfilingModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Profiling extends Controller
{
    //initialize validation rules
    protected array $rules = [
        'fname'     => "required|regex:/^[A-Za-z\s]+$/",
        'mname'     => 'required|regex:/^[A-Za-z\s]+$/',
        'lname'     => 'required|regex:/^[A-Za-z\s]+$/',
        'suffix'    => 'nullable|max:2|alpha',
        'dob'       => 'required|date_format:Y/m/d',
        'age'       => 'required|numeric|digits_between:1,3|max:150',
        'sex'       => 'required|alpha',
        'cstatus'   => 'required|alpha',
        'zone'      => 'required|numeric|digits:1',
        'bplace'    => "required",
        'cpnumber'  => "nullable|regex:/^09\d{9}$/",
        'email'     => 'nullable|email',
        'pwd'       => 'nullable',
        'senior'    => 'nullable'
    ];

    protected array $message = [
        'dob.required'    => 'Birthday is required',
        'dob.date_format' => 'Invalid date format'
    ];

    public function __construct(
        public ProfilingModel $profilingModel
    ){
        $this->$profilingModel = $profilingModel;
    }
    public function render(){
        return view('dashboard.profiling');
    }

    public function add_profile(Request $request): JsonResponse{

        $validator = Validator::make($request->all(), $this->rules, $this->message);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->profilingModel->fill($validator->validated());
        if($this->profilingModel->save()){
            return response()->json(['success' => 'New Profile Inserted'], 200);
        }

        return response()->json(['errors' => 'Server Error'], 500);
    }
}
