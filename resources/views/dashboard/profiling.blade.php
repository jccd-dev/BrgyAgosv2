@extends('main-layout')

@section('title', 'Profiling')

@section('content')
    <div class="col">
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
                        <x-form.input class="col-md-1" name='age' label='Age' type='number'/>
                        <x-form.select class="col-md-1" :options="$data=['F'=>'Female', 'M' => 'Male']" label="Sex" name='sex'/>
                    </x-form-modal>
                </x-modal>

            </div>
        </div>
    </div>
@endsection
