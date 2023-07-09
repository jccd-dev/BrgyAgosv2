import FormSubmit from '../utils/form-submit'
import {clearForm} from '../utils/clearErr'
const importForm = document.querySelector('#import')
const formImportElements = importForm.querySelectorAll('input, select')

importForm.addEventListener('submit', (event) => {
    event.preventDefault()

    let formData = new FormData(event.target)
    let submit = new FormSubmit(formData, '/dashboard/import', formImportElements)
    submit.submitForm()
})

// reset the error messages when modal i closed
let exampleModal = document.getElementById('import')
exampleModal.addEventListener('hide.bs.modal', function (event) {
    formImportElements.forEach((el) => {
            el.nextElementSibling.classList.add("d-none");
            el.nextElementSibling.textContent = '';
    });
})

clearForm(formImportElements)
