import $, { isEmptyObject } from 'jquery'
import axios from 'axios'
import SearchInputs from '../utils/families'

const newCol = `
            <div class="col-12 search-inputs mb-2">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group" id="members">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <button class="btn btn-secondary dropdown-toggle" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Option
                                </button>
                                </div>
                                <input type="text" class="form-control" id="searchInput" data-id="" placeholder="Search...">
                                <div class="dropdown-menu w-100 mt-5" id="optionsContainer">
                                <!-- Options will be dynamically populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" id="roleSelect">
                            <option selected value=''>..Role</option>
                            <option value="Head">Family Head</option>
                            <option value="Husband">Husband/Father</option>
                            <option value="Wife">Wife/Mother</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="GrandMother">Lola</option>
                            <option value="GrandFather">Lolo</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </div>
        `

$(()=>{

    const submitBtn = $('#submit')
    let fam_name = ''
    let cr = ''
    let electricity = ''
    let water = ''
    let val = ''
    let inputVal = ''
    let roleVal = ''


    let searches = $('.member #members')
    let searchData = {}

    $('input, select').each(function(){
        $(this).on('input, change', function(){
            submitBtn.attr('disabled', true)
        })
    })

    $('#addNewInput').on('click', ()=>{
        $('.member').append(newCol)
        submitBtn.attr('disabled', true)
    })


    // update where ever the new members is appended
    const targetNode = $('.member')[0];
    const observer = new MutationObserver(function(mutationsList, observer) {
        // Iterate through each mutation
        for (let mutation of mutationsList) {
          // Check if new nodes were added
          if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
            // Iterate through the added nodes and update them or perform any other actions
            $(mutation.addedNodes).each(function() {
                const inputs  = $(this).find('#members')
                const roles = $(this).find('#roleSelect')

                let search = new SearchInputs(inputs)
                search.onInput()
                search.showOptions()
                search.hideOptions()

                $('#save').on('click', function(e){
                    e.preventDefault()

                    fam_name = $('#family_name').val()
                    cr = $('#cr').val()
                    electricity = $('#electricity').val()
                    water = $('#water').val()

                    const searchInputs = inputs.find('#searchInput')
                    searchInputs.each(function(index) {
                        val = $(this).val()
                        inputVal = $(this).data("id");
                        roleVal = roles.eq(index).val();

                        if(inputVal && roleVal) {
                            searchData[inputVal] = roleVal;
                            return
                        }
                        submitBtn.attr('disabled', true)
                    });

                    if(!isEmptyObject(searchData) && cr != '' && fam_name != '' && water != '' && electricity != '' && val != ''){
                        submitBtn.removeAttr('disabled')
                        return
                    }

                    submitBtn.attr('disabled', true)

                    console.log(searchData)
                })

                $(this).find('#searchInput, #roleSelect').each(function(){
                    $(this).on('change, input', function(){
                        if(this.tagName == 'INPUT'){
                            // console.log( )
                            delete searchData[$(this).data("id")]
                            $(this).data("id", '')
                        }

                        if(this.tagName == 'SELECT'){
                            const searchInput = $(this).closest(".search-inputs").find('#searchInput')
                            const id = searchInput.data('id')
                            console.log(id)
                            if(id != null){
                                delete searchData[id]
                            }
                        }
                        submitBtn.attr('disabled', true)
                    })
                })

            });
          }
        }
      });

    // Configure and start observing the target node for mutations
    const config = { childList: true, subtree: true };
    observer.observe(targetNode, config);


    // when members input are remove it also delete the data on searchData object
    $(document).on("click", ".remove-input", function() {
        const searchInput = $(this).closest(".search-inputs").find('#searchInput')
        const id = searchInput.data('id')
        console.log(id)
        if(id != null){
            delete searchData[id]
        }
        $(this).closest(".search-inputs").remove();
        submitBtn.attr('disabled', true)
    });

    submitBtn.on('click', function(){
        const data = {
            familydata: {
                'famName': fam_name,
                'cr': cr,
                'electrivity': electricity,
                'water' : water
            },
            members : searchData
        }
        axios.post('/dashboard/add-family', data)
            .then( (response) => {

            })
    })

    const findIndexByValue = (obj, value) => {
        for (const key in obj) {
          if (obj[key] === value) {
            return key;
          }
        }
        return null; // Value not found
    };


})
