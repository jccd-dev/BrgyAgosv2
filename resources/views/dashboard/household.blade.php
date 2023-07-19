@extends('main-layout')

@section('title', 'Households')

@section('content')
<div class="row border-bottom border-2 justify-content-between py-2">
    <div class="col-auto">
        <h3 class="">Households</h3>
    </div>
    <div class="col-auto">
        <!-- Button for opening the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#houseModal">
            Add New HouseHold
        </button>
    </div>
</div>
{{-- <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 row my-5"> --}}
    <div class="row dt-row my-5">
        <div class="col">
            <table id="example" class="table table-striped dataTable w-100" aria-describedby="example_info">
              <thead>
                <tr>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Head</th>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Structure</th>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Water</th>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Electricity</th>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">CR</th>
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Waste Management</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
    </div>
{{-- </div> --}}


<!-- Modal -->
<x-modal class="modal-lg" title="Family Details" id="houseModal">
    <x-form-modal id="addInputs">
        <div class="col-md-5">
            <div class="input-group houseHead">
                <div class="input-group-prepend">
                <button class="btn btn-secondary dropdown-toggle rounded-end-0" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    opt
                </button>
                </div>
                <input type="text" class="form-control rounded-end" id="fam_head" data-id="" placeholder="searh for household head">
                <div class="dropdown-menu dropdown-menu-dark w-100 mt-5" id="optionsContainer">
                <!-- Options will be dynamically populated here -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Default select example" id="structure">
                <option selected value="">House Structure</option>
                <option value="Full Concrete" class="fw-bold">Full Concrete</option>
                <option value="Semi Concrete" class="fw-bold">Semi Concrete</option>
                <option value="Light Material (Wood)" class="fw-bold">Light Material (Wood)</option>
                <option value="Salvage House" class="fw-bold">Salvage House</option>
              </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" aria-label="Default select example" id="cr">
                <option selected value="">CR</option>
                <option value="Water Sealed" class="fw-bold">Water Sealed</option>
                <option value="Antipolo type" class="fw-bold">Antipolo type</option>
                <option value="No Latrine" class="fw-bold">No Latrine</option>
                <option value="Using Others Toilet" class="fw-bold">Using Others Toilet</option>
              </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Default select example" id="waste">
                <option selected value="">Waste Handling</option>
                <option value="Burned" class="fw-bold">Burned</option>
                <option value="Burried" class="fw-bold">Burried</option>
                <option value="Recycled" class="fw-bold">Recycled</option>
                <option value="Owned Dumpside" class="fw-bold">Owned Dumpside</option>
                <option value="Collected by Garbage Truck" class="fw-bold">Collected by Garbage Truck</option>
              </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Default select example" id="electricity">
                <option selected value="">Electricity</option>
                <option value="With Electricity" class="fw-bold">With Electricity</option>
                <option value="No Electricity" class="fw-bold">No Electricity</option>
              </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label="Default select example" id="water">
                <option selected value="">Source of Water</option>
                <option value="Deep Well (level 1)" class="fw-bold">Deep Well (level 1)</option>
                <option value="Common (level 2)" class="fw-bold">Common (level 2)</option>
                <option value="Faucet (level 3)" class="fw-bold">Faucet (level 3)</option>
              </select>
        </div>
        <div class="col-12 bg-light text-center fs-4">
            <h4>Family Members</h4>
        </div>
        <div class="col-12 search-inputs mb-2">
            <div class="row">
                <div class="col-md-10 text-center fs-5">
                    <td class="border">Household Members</td>
                </div>
                {{-- default should not delete --}}
                <div class="col-md-2">
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
    <div class="row justify-content-end mt-4">
        <div class="col-md-2">
            <button class="btn btn-warning w-100" id="save">Save</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-teal w-100" id="submit" disabled>Submit Family</button>
        </div>
    </div>
</x-modal>
@vite(['resources/js/pages/household.js'])
@endsection
