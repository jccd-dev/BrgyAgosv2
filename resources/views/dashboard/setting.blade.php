@extends('main-layout')

@section('title', 'Settings')

@section('content')
<div class="row text-center my-5 border-gray border">
    <span class="fs-2 py-2">UPDATE USERNAME AND PASSWORD </span>
</div>
<x-form-modal id="adminSetting" class="d-flex justify-content-center flex-column align-items-center">
    <x-form.input class="col-md-4" name='username' label='User Name' type='text' required='true' placeholder="New username"/>
    <x-form.input class="col-md-4" name='oldpassword' label='Old Password' type='password' required='true' />
    <x-form.input class="col-md-4" name='newpass' label='New Password' type='password' required='true' />
    <x-slot name='button'>
        <x-form.button type='submit' title="Update" btnClass="btn-primary w-50 submit" divClass="col-md-4"/>
    </x-slot>
</x-form-modal>
<div class="row text-center my-5 border-gray border">
    <span class="fs-2 py-2">BACK UP DATABASE</span>
</div>
<div class="row justify-content-center align-items-center g-2 my-5">
    <div class="col text-center">
        <a href="{{route('d-backup')}}" class="href btn btn-teal btn-lg">Back Up DATABASE</a>
    </div>
</div>
@vite(['resources/js/dashboard/updateAdmin.js'])
@endsection
