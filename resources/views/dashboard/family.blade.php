@extends('main-layout')

@section('title', 'Families')

@section('content')
<div class="row border-bottom border-2 justify-content-between py-2">
    <div class="col-auto">
        <h3 class="">FAMILIES</h3>
    </div>
    <div class="col-auto">
        <!-- Button for opening the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#familyModal">
            Add New Family
        </button>
    </div>
</div>
{{-- <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 row my-5"> --}}
    <div class="row dt-row my-5">
        <div class="col">
            <table id="example" class="table table-striped dataTable w-100" aria-describedby="example_info">
              <thead>
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="age: activate to sort column ascending">ID</th>
                  <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="name: activate to sort column descending">Family Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="sex: activate to sort column ascending" >CR</th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="cstatus: activate to sort column ascending" >Electricity</th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="zone: activate to sort column ascending">Water Source</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
    </div>
{{-- </div> --}}


<!-- Modal -->
<x-modal class="modal-lg" title="Family Details" id="familyModal">
    <x-form-modal id="addInputs">
        <div class="col-md-3">
            <input class="form-control" type="text" placeholder="Family Name" aria-label="default input example" id="family_name">
        </div>
        <div class="col-md-3">
            <select class="form-select" aria-label="Default select example" id="cr">
                <option selected value="">CR</option>
                <option value="With CR" class="fw-bold">With CR</option>
                <option value="None" class="fw-bold">None</option>
              </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" aria-label="Default select example" id="electricity">
                <option selected value="">Electricity</option>
                <option value="With Electricity" class="fw-bold">With Electricity</option>
                <option value="None" class="fw-bold">None</option>
              </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" aria-label="Default select example" id="water">
                <option selected value="">Source of Water</option>
                <option value="Nawasa" class="fw-bold">Nawasa</option>
                <option value="Poso" class="fw-bold">Poso</option>
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
                    <button type="button" class="btn btn-success" id="addNewInput"><i class="fa-solid fa-plus"></i></button>
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
@vite(['resources/js/pages/family.js'])
@endsection
