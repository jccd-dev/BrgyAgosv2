{{-- <x-form.input
        label="First Name"
        class="col-md-4"
        type='text'
        model="fname"
    /> --}}
    <div class="col-md-3">
        <label for="inputMname" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="inputMname">
    </div>
    <div class="col-md-4">
        <label for="inputLname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="inputLname">
    </div>
    <div class="col-md-1">
        <label for="inputSuffix" class="form-label">Suffix</label>
        <input type="text" class="form-control" id="inputSuffix" placeholder="Jr, Sr">
    </div>
    <div class="col-1">
        <label for="inputAge" class="form-label">Age</label>
        <input type="number" class="form-control" id="inputAge">
    </div>
    {{-- <x-form.select
        class="col-md-1"
        :options="$data=['F'=>'Female', 'M' => 'Male']"
        label="Sex"
        model='sex'
    /> --}}
    <div class="col-md-2">
        <label for="inputCstatus" class="form-label">Civil Status</label>
        <select id="inputCstatus" class="form-select">
            <option selected>Choose...</option>
            <option value="Married">Married</option>
            <option value="Single">Single</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
        </select>
    </div>
    <div class="col-md-1">
        <label for="inputZone" class="form-label">Zone</label>
        <select id="inputZone" class="form-select">
            <option selected>...</option>
            @for ($i = 1; $i <= 6; $i++)
                <option value='{{$i}}'>{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-2">
        <label for="inputDob" class="form-label">Birt Date</label>
        <input type="text" class="form-control datepicker">
    </div>
    <div class="col-md-3">
        <label for="inputBirthPlace" class="form-label">Birth Place</label>
        <input type="text" class="form-control" id="inputBirthPlace">
    </div>
    <div class="col-md-2">
        <label for="inputPhoneNumber" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="inputPhoneNumber">
    </div>
    <div class="col-md-4">
        <label for="inputEmail" class="form-label">Email <i class="fs-6 fw-light">(optional)</i></label>
        <input type="email" class="form-control" id="inputEmail">
    </div>
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
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="">
                <label class="form-check-label" for="inlineCheckbox2">Senior Citizen</label>
            </div>
            </div>
        </div>
    </div>
