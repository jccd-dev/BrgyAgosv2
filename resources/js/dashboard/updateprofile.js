import FormSubmit from '../utils/form-submit'
import {clearForm} from '../utils/clearErr'
const form = document.querySelector('#updateProfile')
const formElements = form.querySelectorAll('input, select');
const button = form.querySelector('.submit')
import Swal from 'sweetalert2';
import axios from 'axios';
import '../utils/date_picker'

let formChanged = false;
const deleteRes = document.querySelector('#deleteRes');

button.setAttribute('disabled', '');

formElements.forEach((field) => {
    field.addEventListener('input', () => {
      formChanged = true;
      button.removeAttribute('disabled');
    });
});

form.addEventListener('submit', (event) => {
    event.preventDefault()

    let formData = new FormData(event.target)

    let submit = new FormSubmit(formData, '/dashboard/update-profile', formElements, form)
    submit.updateProfile()
})

deleteRes.addEventListener('click', (e) => {
    e.preventDefault()
    let id = e.target.getAttribute('value')

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

        axios.delete(`/dashboard/delete-profile/${id}`)
            .then( response => {
                console.log(response)
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                ).then(()=>{
                    window.location.href = '/dashboard/profiling'
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

clearForm(formElements)
