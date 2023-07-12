import $, { isEmptyObject} from 'jquery'
import axios, { all } from 'axios'
import SearchInputs from '../utils/families'
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';

const newCol = `
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
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            </div>
        `
$(() => {
const submitBtn = $('#submit')
let fam_name = ''
let houseOwnerShip = ''

let deletedData = []
let searchData = {}

$('input, select').each(function(){
    $(this).on('input, change', function(){
        submitBtn.attr('disabled', true)
    })
})

appendMembers()
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

                if (fam_name === '' && houseOwnerShip === '') {
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
    if(id != null && id != ''){
        Swal.fire({
            title: 'Are you sure?',
            text: "Remove it from this family?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
        if (result.isConfirmed){
            if(id != null && id != ''){
                deletedData.push(id)
            }
            $(this).closest(".search-inputs").fadeOut(1000,()=>{
                $(this).closest(".search-inputs").remove()
                setTimeout(()=>{
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }, 300)

            });
            submitBtn.attr('disabled', true)

        }
        console.log(deletedData);
        })
    }else{
        $(this).closest(".search-inputs").fadeOut(1000,()=>{
            $(this).closest(".search-inputs").remove()
        });
    }

    console.log(id)

});


// submit the data family then update the datatable
submitBtn.on('click', function(e){
    // resetModal()
    const data = {
        familydata: {
            'family_name': fam_name,
            'house_ownership': houseOwnerShip,
        },
        members : searchData,
        removedMembers: deletedData,
        famID : $(this).data('id')
    }
    axios.post('/dashboard/update-family-data', data)
        .then( (response) => {
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
        }).catch(err =>{
            console.log(err);
            Swal.fire({
                icon: 'error',
                title: 'Warning',
                text: `${err.response.data.error}`,
            })
        })

})
$('#deleteRes').on('click', (e) => {
    e.preventDefault()
    let id = $(e.target).data('id')

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

            axios.get(`/dashboard/delete-family/${id}`)
                .then( response => {
                    console.log(response)
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(()=>{
                         window.location.href = '/dashboard/families'
                    })
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: `${err.response.datrs} ${err.response.status}`,
                    })
                })

        }
      })
})
})

const get_members = async () => {
    let currURL = window.location.href;
    let urlArr = currURL.split('/')

    let famId = urlArr[urlArr.length -1]
    // console.log(famId);

    try {
        let res = await axios.get(`/dashboard/get-members/${famId}`)

        if(res.status === 200){
            return res.data.members
        }
    }catch (err){
        console.log(err)
    }
}

const appendMembers = () =>{
    get_members().then(res => {
        // console.log(res);
       for (let members in res){
            if(res.hasOwnProperty(members)){
                const member = res[members].resident
                const name = `${member.fname} ${member.lname}`
                $('.member').append(
                    `<div class="col-12 search-inputs mb-2">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group" id="members">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <button class="btn btn-secondary dropdown-toggle rounded-end-0" id="options-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Option
                                    </button>
                                    </div>
                                    <input type="text" class="form-control rounded-end" id="searchInput" data-id="${member.id}" placeholder="Search..." value="${name}">
                                    <div class="dropdown-menu w-100 mt-5" id="optionsContainer">
                                    <!-- Options will be dynamically populated here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="roleSelect">
                                <option selected value=''>..Role (empty)</option>
                                <option value="Head" ${res[members].family_role == 'Head' ? 'selected': ''}>Family Head</option>
                                <option value="Husband" ${res[members].family_role == 'Husband' ? 'selected': ''}>Husband/Father</option>
                                <option value="Wife" ${res[members].family_role == 'Wife' ? 'selected': ''}>Wife/Mother</option>
                                <option value="Son" ${res[members].family_role == 'Son' ? 'selected': ''}>Son</option>
                                <option value="Daughter" ${res[members].family_role == 'Daughter' ? 'selected': ''}>Daughter</option>
                                <option value="GrandMother" ${res[members].family_role == 'GrandMother' ? 'selected': ''}>Lola</option>
                                <option value="GrandFather" ${res[members].family_role == 'GrandFather' ? 'selected': ''}>Lolo</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-input"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>`
                )
            }
       }
    })



}
