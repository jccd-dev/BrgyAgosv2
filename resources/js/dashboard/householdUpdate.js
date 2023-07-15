import $ from 'jquery'
import axios from 'axios'
import SearchInputs from '../utils/families'
import * as bootstrap from 'bootstrap'
import Swal from 'sweetalert2'
import {newCol2} from '../utils/others'

$(()=>{

    let family_head = ''
    let structure = ''
    let cr = ''
    let waste = ''
    let electrcity = ''
    let water = ''
    let head_id = ''

    let familiesData = []
    let deletedFamilies = []

    appendFam()
    // listener for input and select user behaviors
    $('input, select').each(function(){
        $(this).on('input', function(){
            $('#submit').attr('disabled', true)
            if($(this).attr('id') == 'fam_head'){
                $(this).data('id', '')
            }
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

        if(id != null){
            // push the id of the deleted members
            familiesData = familiesData.filter(item => item !== id)
            deletedFamilies.push(id)
        }
        const self = $(this)
        $(this).closest(".search-inputs").fadeOut()
        $('#submit').attr('disabled', true)

        $(this).closest(".search-inputs").remove()


    })

    //visit the family data page
    $(document).on('click', '.see-family', function () {
        const fam_id = $(this).data('id')
        if(fam_id != null || fam_id != ''){
            window.location.href = `/dashboard/update-family/${fam_id}`
        }
    })

    // submit the data to the sever
    $('#submit').on('click', function(e){
        e.preventDefault()

        const data = {
            householddata: {
                'family_head': family_head,
                'h_structure': structure,
                'water_source': water,
                'electricity': electrcity,
                'comfort_room': cr,
                'waste_management': waste,
            },
            members: familiesData,
            deleted: deletedFamilies,
            houseId: $(this).data('id')
        }

        axios.post('/dashboard/update-household', data)
            .then((response)=>{
                if(response.status === 200){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: response.data.success
                        }).then(()=>{
                            window.location.reload()
                        })
                }
            })
            .catch(err => console.log(err))
    })

    $('#save').on('click', function(e) {
        e.preventDefault();
        let searchInputsParent = $('#addInputs .member')
        let searchInputsChilds = searchInputsParent.children('.search-inputs').find('#searchInput')

        const childsArray = Array.from(searchInputsChilds)
        //iterate then remove each one
        childsArray.forEach(child => {
            let inputVal = $(child).data("id");
            if (inputVal) {
                if(!familiesData.includes(inputVal)){
                    $(this).removeClass('border-danger')
                    familiesData.push(inputVal)
                }
            }
        })

        family_head = $('#fam_head').val();
        structure = $('#structure').val()
        cr = $('#cr').val()
        waste = $('#waste').val()
        electrcity = $('#electricity').val()
        water = $('#water').val()
        head_id = $('#fam_head').data("id")

        if (
            family_head != '' &&
            structure != '' &&
            cr != '' &&
            waste != '' &&
            electrcity != '' &&
            water != '' &&
            head_id != ''
        ) {

            if (familiesData.length > 0) {
                $('#submit').removeAttr('disabled');
            } else {
                $('#submit').attr('disabled', true);
            }
        } else {
            $('#submit').attr('disabled', true);

        }

        console.log(familiesData);
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
                console.log(family);
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
                                        <input type="text" class="form-control rounded-end" id="searchInput" data-id="${family.id}" value='${family.family_name}' placeholder="Search..." >
                                        <div class="dropdown-menu w-100 mt-5" id="optionsContainer">
                                        <!-- Options will be dynamically populated here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
                                <button type="button" class="btn btn-warning see-family" data-id="${family.id}"><i class="fa-solid fa-eye"></i></button>
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
