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
        <x-modal class="modal-xl" title="Profiling">
            <x-form-modal id="addProfile">
                <x-form.input class="col-md-4" name='fname' label='First Name' type='text'/>
                <x-form.input class="col-md-3" name='mname' label='Middle Name' type='text'/>
                <x-form.input class="col-md-4" name='lname' label='Last Name' type='text'/>
                <x-form.input class="col-md-1" name='suffix' label='Suffix' type='text'/>
                <x-form.input class="col-md-2" name='bod' label='Birth Date' type='text' inputClass='datepicker'/>
                <x-form.input class="col-md-1" name='age' label='Age' type='number'/>
                <x-form.select class="col-md-1" :options="$data=['F'=>'Female', 'M' => 'Male']" label="Sex" name='sex'/>
                <x-form.select class="col-md-2"
                    :options="$data=['Married'=>'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed']"
                    label="Civil Status"
                    name='cstatus'
                />
                <x-form.select class="col-md-1"
                    :options="$data=['1'=>1, '2' => 2, '3'=> 3, '4'=> 4, '5'=>5]"
                    label="Zone"
                    name='zone'
                />
                <x-form.input class="col-md-3" name='bplace' label='Birth Place' type='text'/>
                <x-form.input class="col-md-2" name='cpnumber' label='Phone Number' type='text'/>
                <x-form.input class="col-md-4" name='email' label='Email' type='email' placeholder="Optional"/>

                {{-- addtional form elemements ( not component) --}}
                <div class="col-md-6">
                    <label for="form-label">Other Options</label>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check form-check-inline py-2">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="">
                                <label class="form-check-label" for="inlineCheckbox1">PWD</label>
                            </div>
                        </div>
                        <div class="col-4">
                        <div class="form-check form-check-inline py-2">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="sc" value="1">
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
