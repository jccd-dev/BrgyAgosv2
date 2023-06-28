import $ from 'jquery'
import axios from 'axios';
import Swal from 'sweetalert2'
import './bootstrap';

let form = document.querySelector('#loginForm')
let inputs = form.querySelector('input')

form.addEventListener('submit', async (event) => {
    event.preventDefault()

    let formData = new FormData(event.target)
    try {
        let res = await axios.post('/login', formData)
        if(res.status === 200){
            window.location.href = '/dashboard'
        }
    } catch (error) {
        if(error.response.status === 420){
            loginError(error)
        }
        errorHanlder(error.response.data.errors)
    }
})

function errorHanlder(err) {
    for (const key in err) {
        inputs.forEach( el => {
            if (el.name === key) {
                el.classList.add('border-danger')
                el.nextElementSibling.textContent = err[key];
                el.nextElementSibling.classList.add('text-danger')

                el.addEventListener('keydown', (e) => {
                    el.classList.remove('border-danger')
                    el.nextElementSibling.textContent = key;
                    el.nextElementSibling.classList.remove('text-danger')
                    if(el.value.trim() === ''){
                        el.classList.add('border-danger')
                        el.nextElementSibling.textContent = err[key];
                        el.nextElementSibling.classList.add('text-danger')
                    }
                })
            }
        });
    }
}

function loginError(err){
    Swal.fire(
        'Invalid Login!',
        err.response.data.errors,
        'warning'
      )
}
