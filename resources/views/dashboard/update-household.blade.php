@extends('main-layout')

@section('title', 'Families')
{{-- {{ dd($data)}} --}}
@section('content')
<div class="row my-3">
    <di class="col-10">
        <div class="border bg-light d-flex align-items-center rounded">
            <div class="px-2 w-100">
                <div class="d-flex flex-column">
                    <span class="border-bottom py-1">Household Head</span>
                    <h1 class="fs-2">{{$data->family_head}}</h1>
                </div>
            </div>
        </div>
    </di>
    <div class="col-2">
        <div class="row pb-1">
            <div class="col">
                <button class="btn btn-danger w-100" data-id="" id="deleteRes">Delete</button>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <a href="{{route('d-household.main')}}" class="btn btn-dark w-100">Back</a>
            </div>
        </div>
    </div>
</div>
<x-form-modal id="addInputs">
    <div class="col-md-4">
        <label for="fam_head" class="form-label">Household Head</label>
        <div class="input-group houseHead">
            <div class="input-group-prepend">
            <button class="btn btn-secondary dropdown-toggle rounded-end-0" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            </div>
            <input type="text" class="form-control rounded-end" id="fam_head" data-id="{{$data->family_head}}" placeholder="searh for household head" value="{{$data->family_head}}">
            <div class="dropdown-menu dropdown-menu-dark w-100 mt-5" id="optionsContainer">
            <!-- Options will be dynamically populated here -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="structure" class="form-label">House Structure</label>
        <select class="form-select" aria-label="Default select example" id="structure">
            <option selected value="{{$data->h_structure}}">{{$data->h_structure}}</option>
            <option value="Full Concrete" class="fw-bold">Full Concrete</option>
            <option value="Semi Concrete" class="fw-bold">Semi Concrete</option>
            <option value="Light Material (Wood)" class="fw-bold">Light Material (Wood)</option>
            <option value="Salvage House" class="fw-bold">Salvage House</option>
          </select>
    </div>
    <div class="col-md-4">
        <label for="cr" class="form-label">Rest Room / CR</label>
        <select class="form-select" aria-label="Default select example" id="cr">
            <option selected value="{{$data->comfort_room}}">{{$data->comfort_room}}</option>
            <option value="Water Sealed" class="fw-bold">Water Sealed</option>
            <option value="Antipolo type" class="fw-bold">Antipolo type</option>
            <option value="No Latrine" class="fw-bold">No Latrine</option>
            <option value="Using Others Toilet" class="fw-bold">Using Others Toilet</option>
          </select>
    </div>
    <div class="col-md-4">
        <label for="waste" class="form-label">Waste Management</label>
        <select class="form-select" aria-label="Default select example" id="waste">
            <option selected value="{{$data->waste_management}}">{{$data->waste_management}}</option>
            <option value="Burned" class="fw-bold">Burned</option>
            <option value="Burried" class="fw-bold">Burried</option>
            <option value="Recycled" class="fw-bold">Recycled</option>
            <option value="Owned Dumpside" class="fw-bold">Owned Dumpside</option>
            <option value="Collected by Garbage Truck" class="fw-bold">Collected by Garbage Truck</option>
          </select>
    </div>
    <div class="col-md-4">
        <label for="electricity" class="form-label">Electricity</label>
        <select class="form-select" aria-label="Default select example" id="electricity">
            <option selected value="{{$data->electricity}}">{{$data->electricity}}</option>
            <option value="With Electricity" class="fw-bold">With Electricity</option>
            <option value="No Electricity" class="fw-bold">No Electricity</option>
          </select>
    </div>
    <div class="col-md-4">
        <label for="water" class="form-label">Source of Water</label>
        <select class="form-select" aria-label="Default select example" id="water">
            <option selected value="{{$data->water_source}}">{{$data->water_source}}</option>
            <option value="Deep Well (level 1)" class="fw-bold">Deep Well (level 1)</option>
            <option value="Common (level 2)" class="fw-bold">Common (level 2)</option>
            <option value="Faucet (level 3)" class="fw-bold">Faucet (level 3)</option>
          </select>
    </div>
    <div class="col-12 bg-light text-center fs-4">
        <h4>Household Family Member(s)</h4>
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
                <button type="button" class="btn btn-success" id="addNewInput" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Row/Members"><i class="fa-solid fa-plus"></i></button>
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
<div class="row justify-content-end mt-4 mb-5">
    <div class="col-md-2">
        <button class="btn btn-warning w-100" id="save">Save</button>
    </div>
    <div class="col-md-3">
        <button class="btn btn-teal w-100" id="submit" disabled data-id="{{$data->id}}">Submit Family</button>
    </div>
</div>
@vite(['resources/js/dashboard/householdUpdate.js'])
@endsection
