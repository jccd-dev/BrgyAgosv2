export const newCol1 = `
            <div class="col-12 search-inputs mb-2">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group" id="members">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <button class="btn btn-secondary dropdown-toggle rounded-end-0" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Option
                                </button>
                                </div>
                                <input type="text" class="form-control rounded-end" id="searchInput" data-id="" placeholder="Search...">
                                <div class="dropdown-menu w-100 mt-5" id="optionsContainer">
                                <!-- Options will be dynamically populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" id="roleSelect">
                            <option selected value=''>..Role (empty)</option>
                            <option value="Head">Family Head</option>
                            <option value="Husband">Husband/Father</option>
                            <option value="Wife">Wife/Mother</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="GrandMother">Lola</option>
                            <option value="GrandFather">Lolo</option>
                            <option value="Solo Parent">Solo Parent</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </div>
        `

export const newCol2 = `
    <div class="col-12 search-inputs mb-2">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group" id="members">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <button class="btn btn-secondary dropdown-toggle rounded-end-0" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Option
                        </button>
                        </div>
                        <input type="text" class="form-control rounded-end" id="searchInput" data-id="" placeholder="Search...">
                        <div class="dropdown-menu w-100 mt-5" id="optionsContainer">
                        <!-- Options will be dynamically populated here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </div>
    </div>
`
