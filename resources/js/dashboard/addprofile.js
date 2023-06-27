import $ from 'jquery'
import FormSubmit from '../utils/form-submit'
import clearForm from '../utils/clearErr'
const form = document.querySelector('#addProfile')
const formElements = form.querySelectorAll('input, select')

form.addEventListener('submit', (event) => {
    event.preventDefault()
    let formData = new FormData(event.target)

    let submit = new FormSubmit(formData, '/dashboard/add-profile', formElements, form)
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

clearForm(formElements)

