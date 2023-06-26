import $ from 'jquery'
import FormSubmit from '../utils/form-submit'
const form = document.querySelector('#addProfile')
const formElements = form.querySelectorAll('input, select')

form.addEventListener('submit', async (event) => {
    event.preventDefault()
    let formData = new FormData(event.target)

    let submit = new FormSubmit(formData, '/dashboard/add-profile', formElements)
    submit.submitForm()
})

// reset the error messages when modal i closed
let exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('hide.bs.modal', function (event) {
    formElements.forEach((el) => {
            el.nextElementSibling.classList.add("d-none");
            el.nextElementSibling.textContent = '';
    });
})

// remove error message when user change the value,
// but brings it back when user delete the value
formElements.forEach(element => {

    // only for datepicker
    element.addEventListener('focus', ()=>{
        if(element.className == 'form-control datepicker'){
            element.nextElementSibling.classList.add("d-none");
        }
    })
    element.addEventListener('blur', ()=>{
        if(element.className == 'form-control datepicker'){
            if(element.value.trim() === ''){
                element.nextElementSibling.classList.remove("d-none");
            }
        }
    })
    // only for datepicker

    element.addEventListener('keydown', (e) => {
        element.nextElementSibling.classList.add("d-none");
        if(element.value.trim() === ''){
            element.nextElementSibling.classList.remove("d-none");
        }
    })

  })
