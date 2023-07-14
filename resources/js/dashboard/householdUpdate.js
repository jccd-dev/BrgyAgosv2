import $ from 'jquery'
import axios from 'axios'
import SearchInputs from '../utils/families'
import * as bootstrap from 'bootstrap'
import Swal from 'sweetalert2'
import {newCol2} from '../utils/others'

$(()=>{
    appendFam()
    let family_head = ''
    let structure = ''
    let cr = ''
    let waste = ''
    let electrcity = ''
    let water = ''

    let familiesData = []
    let deletedFamilies = []

    // listener for input and select user behaviors
    $('input, select').each(function(){
        $(this).on('input, change', function(){
            $('#submit').attr('disabled', true)
        })
    })

    //append new household family inputs
    $('#addNewInput').on('click', ()=> {
        $('.member').append(newCol2)
    })

    // delete the appended inputs
    $(document).on('click', '.remove-input', function () {
        const searchInputs = $(this).closest(".search-inputs").find('#searchInput')
        const id = searchInputs.data('id')
        console.log(id);
        if(id != null){
            // push the id of the deleted members
            deletedFamilies.push(id)
        }
        $(this).closest(".search-inputs").fadeOut(550, ()=>{
            $(this).remove()
        })
        $('#submit').attr('disabled', true)
    })

     //populate options for household head input
     const headInput = $('.houseHead')
     let fam_head = new SearchInputs(headInput)
     fam_head.onInput('householdHead', '/dashboard/get-famheads')
     fam_head.showOptions()
     fam_head.hideOptions()

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

                let search = new SearchInputs(inputs)
                search.onInput('household', '/dashboard/get-familiesOpt')
                search.showOptions()
                search.hideOptions()


                $('#save').on('click', function(e) {
                    e.preventDefault();

                    family_head = $('#fam_head').val();
                    structure = $('#structure').val()
                    cr = $('#cr').val()
                    waste = $('#waste').val()
                    electrcity = $('#electricity').val()
                    water = $('#water').val()
                    head_id = $('#fam_head').data("id")

                    //then get all fam head data in appended inputs
                    const searchInputs = inputs.find('#searchInput');
                    searchInputs.each(function(index) {
                        let inputVal = $(this).data("id");
                        console.log(inputVal)
                        if (inputVal) {
                            $(this).removeClass('border-danger')
                            familiesData.push(inputVal)
                        }
                    });
                    console.log([family_head, structure, cr, waste, electrcity, water]);

                    if (
                        family_head != '' &&
                        structure != '' &&
                        cr != '' &&
                        waste != '' &&
                        electrcity != '' &&
                        water != '' &&
                        head_id != ''
                    ) {

                        if (familiesData.length) {
                            $('#submit').removeAttr('disabled');
                        } else {
                            $('#submit').attr('disabled', true);
                        }
                    } else {
                        console.log('empty');
                        $('#submit').attr('disabled', true);
                    }

                    // e.stopPropagation()
                });



                $(this).find('#searchInput').each(function(){
                    $(this).on('change, input', function(){
                        // remove data from the familiesData (family id)
                        familiesData = familiesData.filter(item => item !== id)
                        $(this).data("id", '')
                        if(!$(this).data("id")){
                            $(this).addClass('border-danger')
                        }
                        else{
                            $(this).removeClass('border-danger')
                        }
                        $('#submit').attr('disabled', true)
                    })
                })

            });
          }
        }
      });

    // Configure and start observing the target node for mutations
    const config = { childList: true, subtree: true };
    observer.observe(targetNode, config);
})

const get_house_members = async () => {
    let currURL = window.location.href
    let urlArr = currURL.split('/')

    const house_id = urlArr[urlArr.length -1]
     try {
        let res = await axios.get(`/dashboard/get-household-families/${house_id}`)

        if(res.status === 200){
            return res.data.fam
            // console.log(res.data.fam);
        }
     } catch (error) {
        console.log(error);
     }
}

const appendFam = () => {
    get_house_members().then(res => {
        for (let families in res){
            if(res.hasOwnProperty(families)){
                const family = res[families].families
                $('.member').append(
                    `
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
                                        <input type="text" class="form-control rounded-end" id="searchInput" data-id="${family.id}" placeholder="Search..." value=${family.family_name}>
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
                )
            }
        }
    })
    .catch(err => console.log(err))
}
