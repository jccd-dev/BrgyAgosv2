import $, { data } from 'jquery'
import axios from 'axios'
import SearchInputs from '../utils/families'
import * as bootstrap from 'bootstrap'
import Swal from 'sweetalert2'
import { get_households } from '../dashboard/get-data'
import { initializeDataTable, updateDataTableData } from '../utils/householdDatatables'
import {newCol2} from '../utils/others'

$((document)=>{
    get_households().then(data => {
        initializeDataTable(data)
    }).catch(err => console.log(err))

    let family_head = ''
    let structure = ''
    let cr = ''
    let waste = ''
    let electrcity = ''
    let water = ''
    let head_id = ''

    let familiesData = []

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
            // remove data from the familiesData (family id)
            familiesData = familiesData.filter(item => item !== id)
        }
        $(this).closest(".search-inputs").fadeOut(550, ()=>{
            $(this).remove()
        })
        $('#submit').attr('disabled', true)
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
            members: familiesData
        }

        axios.post('/dashboard/add-household', data)
            .then((response)=>{
                if(response.status === 200){
                    resetModal()
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
                            get_households().then(data => {
                                updateDataTableData(data)
                            })
                        })
                }
            })
            .catch(err => console.log(err))


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

function resetModal()
{

    let searchInputsParent = $('#addInputs .member')
    let searchInputsChilds = searchInputsParent.children('.search-inputs')

    const childsArray = Array.from(searchInputsChilds)
    //iterate then remove each one
    childsArray.forEach(child => {
        child.remove()
    })
    //then reset the details


    $('#fam_head').val('');
    $('#structure').val('')
    $('#cr').val('')
    $('#waste').val('')
    $('#electricity').val('')
    $('#water').val('')

    let modalElement = $('#houseModal')
    let modal = bootstrap.Modal.getInstance(modalElement)

    modal.hide();
}



