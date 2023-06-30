@extends('main-layout')

@section('title', 'Profiling')
{{-- {{ dd($data)}} --}}
@section('content')
<div class="row my-3">
    <di class="col-6">
        <div class="border bg-light d-flex align-items-center rounded">
            <div class="px-2 w-100">
                <div class="d-flex flex-column">
                    <span class="border-bottom py-1">Profile of</span>
                    <h1 class="fs-2">{{ strtoupper("{$user->fname} {$user->lname}") }}</h1>
                </div>
            </div>
        </div>
    </di>
    <div class="col-4">
        <div class="border bg-light d-flex align-items-center rounded">
            <div class="px-2">
                <div class="d-flex flex-column w-full">
                    <span class="border-bottom py-1">Family</span>
                    <h1 class="fs-2">DIGAY</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="row-cols-1">
            <div class="col">
                <button class="btn btn-warning w-100">Add Case</button>
            </div>
            <div class="col d-lg-flex flex-row">
                <a href="{{route('d-profiling')}}" class="btn btn-dark w-50">Back</a>
                <button class="btn btn-danger w-50" value="{{$user->id}}" id="deleteRes">Delete</button>
            </div>
        </div>
    </div>
</div>
<hr class="border-dark border-2">
<x-form-modal id="updateProfile">
    <x-form.input class="col-md-4 d-none" name='id' label='id' type='hidden' :value="$user->id"/>
    <x-form.input class="col-md-4" name='fname' label='First Name' type='text' required='true' :value="$user->fname"/>
    <x-form.input class="col-md-4" name='mname' label='Middle Name' type='text' required='true' :value="$user->mname"/>
    <x-form.input class="col-md-4" name='lname' label='Last Name' type='text' required='true' :value="$user->lname"/>
    <x-form.input class="col-md-3" name='suffix' label='Suffix' type='text' :value="$user->suffix"/>
    <x-form.input class="col-md-3" name='dob' label='Birth Date' type='text' inputClass='datepicker' placeholder="m/d/Y" required='true' inputId='datepicker' :value="$user->dob"/>
    <x-form.input class="col-md-3" name='age' label='Age' type='number' required='true' inputId='age' :value="$user->age"/>
    <x-form.select class="col-md-3" :options="$data=['Female'=>'Female', 'Male' => 'Male']" label="Sex" name='sex' required='true' :value="$user->sex"/>
    <x-form.select class="col-md-2" required='true'
        :options="$data=['Married'=>'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed']"
        label="Civil Status"
        name='cstatus'
        :value="$user->cstatus"
    />
    <x-form.select class="col-md-2"
        :options="$data=['1'=>1, '2' => 2, '3'=> 3, '4'=> 4, '5'=>5, '6'=> 6]"
        label="Zone"
        name='zone'
        required='true'
        :value="$user->zone"
    />
    <x-form.input class="col-md-5" name='bplace' label='Birth Place' type='text' required='true' :value="$user->bplace"/>
    <x-form.input class="col-md-3" name='cpnumber' label='Phone Number' type='text' :value="$user->cpnumber"/>
    <x-form.input class="col-md-4" name='email' label='Email' type='email' placeholder="Optional" :value="$user->email"/>

    {{-- addtional form elemements ( not component) --}}
    <div class="col">
        <label for="form-label">Other Options</label>
        <div class="row">
            <div class="col-3">
                <div class="form-check form-check-inline py-2">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="pwd" value="pwd" @checked(!empty($user->pwd))>
                    <label class="form-check-label" for="inlineCheckbox1">PWD</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-check form-check-inline py-2">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="senior" value="sc" @checked(!empty($user->senior))>
                    <label class="form-check-label" for="inlineCheckbox2">Senior Citizen</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-check form-check-inline py-2">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="deceased" value="decd" @checked(!empty($user->deseased))>
                    <label class="form-check-label" for="inlineCheckbox2">Deceased</label>
                </div>
            </div>
        </div>
    </div>
    <x-slot name='button'>
        <x-form.button type='submit' title="Update" btnClass="btn-primary w-25 submit" divClass="col-12 d-flex justify-content-end"/>
    </x-slot>
</x-form>
@vite(['resources/js/dashboard/updateprofile.js'])
@endsection
