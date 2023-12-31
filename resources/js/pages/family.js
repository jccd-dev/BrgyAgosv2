import $, { isEmptyObject } from 'jquery'
import axios from 'axios'
import SearchInputs from '../utils/families'
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';

import {get_families} from '../dashboard/get-data'
import { initializeDataTable, updateDataTableData } from '../utils/familyDatatable'
import {newCol1} from '../utils/others'


$(()=>{

    // display all families in datatable
    get_families().then(data => {
        initializeDataTable(data)
    }).catch(error => {console.log(error)})

    const submitBtn = $('#submit')
    let fam_name = ''
    let houseOwnerShip = ''


    let searchData = {}

    $('input, select').each(function(){
        $(this).on('input, change', function(){
            submitBtn.attr('disabled', true)
        })
    })

    $('#addNewInput').on('click', ()=>{
        $('.member').append(newCol1)
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
                search.onInput('families', '/dashboard/get-option')
                search.showOptions()
                search.hideOptions()


                $('#save').on('click', function(e) {
                    e.preventDefault();

                    fam_name = $('#family_name').val();
                    houseOwnerShip = $('#houseOwnerShip').val();

                    const searchInputs = inputs.find('#searchInput');
                    searchInputs.each(function(index) {
                        let inputVal = $(this).data("id");
                        let roleVal = roles.eq(index).val();
                        let select = $(this).closest(".search-inputs").find('#roleSelect')
                        // console.log(inputVal, roleVal);

                        if (inputVal && roleVal !== '') {
                            $(this).removeClass('border-danger')
                            select.removeClass('border-danger')
                            searchData[inputVal] = roleVal;
                        }
                    });

                    if (fam_name !== '' && houseOwnerShip !== '') {
                        if (!isEmptyObject(searchData)) {
                            submitBtn.removeAttr('disabled');
                        } else {
                            submitBtn.attr('disabled', true);
                        }
                    } else {
                        submitBtn.attr('disabled', true);
                    }

                });



                $(this).find('#searchInput, #roleSelect').each(function(){
                    $(this).on('change, input', function(){
                        if(this.tagName == 'INPUT'){
                            // console.log( )
                            delete searchData[$(this).data("id")]
                            $(this).data("id", '')
                            if(!$(this).data("id")){
                                $(this).addClass('border-danger')

                            }
                            else{
                                $(this).removeClass('border-danger')
                            }

                        }

                        if(this.tagName == 'SELECT'){
                            const searchInput = $(this).closest(".search-inputs").find('#searchInput')
                            $(this).addClass('border-danger')
                            const id = searchInput.data('id')
                            // console.log(id)
                            if(id != null){
                                delete searchData[id]
                            }

                            if(!$(this).val()){
                                $(this).addClass('border-danger')

                            }
                            else{
                                $(this).removeClass('border-danger')
                                $('#alert').addClass('d-none')
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


    // submit the data family then update the datatable
    submitBtn.on('click', function(e){

        // resetModal()
        const data = {
            familydata: {
                'family_name': fam_name,
                'house_ownership' : houseOwnerShip
            },
            members : searchData
        }
        axios.post('/dashboard/add-family', data)
            .then( (response) => {
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
                            get_families().then(data => {
                                updateDataTableData(data)
                            })
                        })
                }
            }).catch(err =>{
                console.log(err)
            })

    })
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

    $('#family_name').val('');
    $('#houseOwnerShip').val('');

    let modalElement = $('#familyModal')
    let modal = bootstrap.Modal.getInstance(modalElement)

    modal.hide();
}
