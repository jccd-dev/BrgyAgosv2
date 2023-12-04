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
                    <h1 class="fs-2">{{ strtoupper("{$user->fname}") }}</h1>
                </div>
            </div>
        </div>
    </di>
    <div class="col-4">
        <div class="border bg-light d-flex align-items-center rounded">
            <div class="px-2">
                <div class="d-flex flex-column w-full">
                    <span class="border-bottom py-1">Family Name</span>
                    <h1 class="fs-2">{{ strtoupper("{$user->lname}") }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="row pb-1">
            <div class="col">
                <a href="{{route('d-profiling')}}" class="btn btn-dark w-100">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-danger w-100" value="{{$user->id}}" id="deleteRes">Delete</button>
            </div>
        </div>
    </div>
</div>
<hr class="border-dark border-2">
<x-form-modal id="updateProfile">
    <x-form.input class="col-md-4 d-none" name='id' label='id' type='hidden' :value="$user->id"/>
    <x-form.input class="col-md-4" name='fname' label='First Name' type='text' required='true' :value="$user->fname"/>
    <x-form.input class="col-md-3" name='mname' label='Middle Name' type='text' required='true' :value="$user->mname"/>
    <x-form.input class="col-md-3" name='lname' label='Last Name' type='text' required='true' :value="$user->lname"/>
    <x-form.input class="col-md-2" name='suffix' label='Suffix' type='text' :value="$user->suffix"/>

    <x-form.input class="col-md-6" name='bplace' label='Birth Place' type='text' required='true' :value="$user->bplace"/>
    <x-form.input class="col-md-3" name='dob' label='Birth Date' type='text' inputClass='datepicker' placeholder="m/d/Y" required='true' inputId='datepicker' :value="$user->dob"/>
    <x-form.input class="col-md-3" name='age' label='Age' type='number' required='true' inputId='age' :value="$user->age"/>

    <x-form.select class="col-md-3" :options="$data=['Female'=>'Female', 'Male' => 'Male']" label="Sex" name='sex' required='true' :value="$user->sex"/>
    <x-form.select class="col-md-3" required='true'
        :options="$data=['Married'=>'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed']"
        label="Civil Status"
        name='cstatus'
        :value="$user->cstatus"
    />
    <x-form.select class="col-md-3"
        :options="$data=['1'=>1, '2' => 2, '3'=> 3, '4'=> 4, '5'=>5, '6'=> 6]"
        label="Zone"
        name='zone'
        required='true'
        :value="$user->zone"
    />

    <x-form.input class="col-md-3" name='cpnumber' label='Phone Number' type='text' :value="$user->cpnumber"/>
    <x-form.select class="col-md-4"
        :options="$data=['None'=> 'None', 'Elementary' => 'Elementary', 'HighSchool'=> 'HighSchool', 'College'=>'College']"
        label="Education Attainment"
        name='edu_attain'
        required='true'
        :value="$user->edu_attain"
    />
    <x-form.input class="col-md-5" name='occupation' label='Occupation' type='text' required="true" :value="$user->occupation"/>

    {{-- addtional form elemements ( not component) --}}
    <div class="col-md-12">
        <label for="form-label">Other Options</label>
        <div class="row">
            <div class="col-3">
                <div class="form-check form-check-inline py-2">
                    <label class="form-check-label" for="inlineCheckbox1">PWD</label>
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="pwd" value="pwd" @checked(!empty($user->pwd))>
                </div>
            </div>
            <div class="col-4">
                <div class="form-check form-check-inline py-2">
                    <label class="form-check-label" for="inlineCheckbox2">Senior Citizen</label>
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="senior" value="sc" @checked(!empty($user->senior))>
                </div>
            </div>
            <div class="col-3">
                <div class="form-check form-check-inline py-2">
                    <label class="form-check-label" for="inlineCheckbox2">Deceased</label>
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="deceased" value="decd" @checked(!empty($user->deseased))>
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
