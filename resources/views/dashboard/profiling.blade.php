@extends('main-layout')

@section('title', 'Profiling')

@section('content')
<div class="row">
    <div class="mt-2 flex align-content-end border-bottom border-2 py-2 col mx-2">
        <!-- Button for opening the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Resident Record
        </button>

        <!-- Modal -->
        <x-modal class="modal-lg" title="Profiling">
            <x-form-modal id="addProfile">
                <x-form.input class="col-md-4" name='fname' label='First Name' type='text' required='true'/>
                <x-form.input class="col-md-4" name='mname' label='Middle Name' type='text' required='true'/>
                <x-form.input class="col-md-4" name='lname' label='Last Name' type='text' required='true'/>
                <x-form.input class="col-md-3" name='suffix' label='Suffix' type='text'/>
                <x-form.input class="col-md-3" name='bod' label='Birth Date' type='text' inputClass='datepicker' placeholder="m/d/Y" required='true' inputId='datepicker'/>
                <x-form.input class="col-md-3" name='age' label='Age' type='number' required='true'/>
                <x-form.select class="col-md-3" :options="$data=['Female'=>'Female', 'Male' => 'Male']" label="Sex" name='sex' required='true'/>
                <x-form.select class="col-md-2" required='true'
                    :options="$data=['Married'=>'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed']"
                    label="Civil Status"
                    name='cstatus'
                />
                <x-form.select class="col-md-2"
                    :options="$data=['1'=>1, '2' => 2, '3'=> 3, '4'=> 4, '5'=>5]"
                    label="Zone"
                    name='zone'
                    required='true'
                />
                <x-form.input class="col-md-5" name='bplace' label='Birth Place' type='text' required='true'/>
                <x-form.input class="col-md-3" name='cpnumber' label='Phone Number' type='text'/>
                <x-form.input class="col-md-4" name='email' label='Email' type='email' placeholder="Optional"/>

                {{-- addtional form elemements ( not component) --}}
                <div class="col-md-8">
                    <label for="form-label">Other Options</label>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-check-inline py-2">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="pwd" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">PWD</label>
                            </div>
                        </div>
                        <div class="col-4">
                        <div class="form-check form-check-inline py-2">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="senior" value="1">
                            <label class="form-check-label" for="inlineCheckbox2">Senior Citizen</label>
                        </div>
                        </div>
                    </div>
                </div>
                <x-slot name='button'>
                    <x-form.button type='submit' title="Add Profile" btnClass="btn-primary w-25" divClass="col-12 d-flex justify-content-end"/>
                </x-slot>
            </x-form-modal>
        </x-modal>

    </div>
</div>
@endsection