import $ from 'jquery'
import FormSubmit from '../utils/form-submit'
const form = document.querySelector('#addProfile')
const formElements = document.querySelector('#addProile input', '#addProfile select')

form.addEventListener('submit', async (event) => {
    event.preventDefault()

    let formData = new FormData(event.target)

    let submit = new FormSubmit(formData, '/add-profile', formElements)
    submit.submitForm()
})

