@extends('main-layout')

@section('title', 'Families')
{{-- {{ dd($data)}} --}}
@section('content')
<div class="row my-3">
    <di class="col-10">
        <div class="border bg-light d-flex align-items-center rounded">
            <div class="px-2 w-100">
                <div class="d-flex flex-column">
                    <span class="border-bottom py-1">Profile of</span>
                    <h1 class="fs-2">{{ strtoupper("{$fam_data->family_name}") }} FAMILY</h1>
                </div>
            </div>
        </div>
    </di>
    <div class="col-2">
        <div class="row pb-1">
            <div class="col">
                <button class="btn btn-danger w-100" data-id="{{$fam_data->id}}" id="deleteRes">Delete</button>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <a href="{{route('d-family')}}" class="btn btn-dark w-100">Back</a>
            </div>
        </div>
    </div>
</div>
<x-form-modal id="addInputs">
    <div class="col-md-3">
        <input class="form-control" type="text" placeholder="Family Name" aria-label="default input example" id="family_name" value="{{$fam_data->family_name}}">
    </div>
    <div class="col-md-3">
        <select class="form-select" aria-label="Default select example" id="cr">
            <option selected value="">CR</option>
            <option value="With CR" class="fw-bold" {{ $fam_data->with_Cr == 'With CR' ? 'selected' : ''}}>With CR</option>
            <option value="None" class="fw-bold" {{ $fam_data->with_Cr == 'None' ? 'selected' : ''}}>None</option>
          </select>
    </div>
    <div class="col-md-3">
        <select class="form-select" aria-label="Default select example" id="electricity">
            <option selected value="">Electricity</option>
            <option value="With Electricity" class="fw-bold" {{ $fam_data->with_electricity == 'With Electricity' ? 'selected' : ''}}>With Electricity</option>
            <option value="None" class="fw-bold" {{ $fam_data->with_electricity == 'None' ? 'selected' : ''}}>None</option>
          </select>
    </div>
    <div class="col-md-3">
        <select class="form-select" aria-label="Default select example" id="water">
            <option selected value="">Source of Water</option>
            <option value="Nawasa" class="fw-bold" {{ $fam_data->water_source == 'Nawasa' ? 'selected' : ''}}>Nawasa</option>
            <option value="Poso" class="fw-bold" {{ $fam_data->water_source == 'Poso' ? 'selected' : ''}}>Poso</option>
          </select>
    </div>
    <div class="col-12 bg-light text-center fs-4">
        <h4>Family Members</h4>
    </div>
    <div class="col-12 search-inputs mb-2">
        <div class="row">
            <div class="col-7 text-center fs-5">
                <td class="border">Family Member Name</td>
            </div>
            <div class="col-4 text-center fs-5">
                <td class="w-100">Family Role</td>
            </div>
            {{-- default should not delete --}}
            <div class="col-md-1">
                <button type="button" class="btn btn-success" id="addNewInput" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Row/Members"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="member">

    </div>

</x-form-modal>
<div class="row justify-content-center mt-2">
    <div class="col fs-7 text-muted text-center">
        <p><i><strong>Warning! </strong> Row field(s) that has a red border or empty value will not be included in data submittion</i> </p>
    </div>
</div>
<div class="row justify-content-end mt-4">
    <div class="col-md-2">
        <button class="btn btn-warning w-100" id="save">Save</button>
    </div>
    <div class="col-md-3">
        <button class="btn btn-teal w-100" id="submit" data-id="{{$fam_data->id}}" disabled>Update Family</button>
    </div>
</div>
@vite(['resources/js/dashboard/updatefamily.js'])
@endsection