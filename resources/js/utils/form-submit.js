import axios from 'axios'
import Swal from 'sweetalert2'

// set the csrf token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

class FormSubmit{
    constructor(formData, end_point, formElements){
        this.formData = formData
        this.end_point = end_point
        this.formElements = formElements
    }

    // submit form to the server/backend
    async submitForm(){
        try {
            let res = await axios.post(endPoint, formData)
            if(res.status === 200){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                  Toast.fire({
                    icon: 'success',
                    title: res.data.success
                  })
            }
        } catch (error) {
            this.errorHanlder(error.response?.data?.errors)
        }
    }
    // display the error message under the input and select if any
    errorHanlder(){
        // this.formElements.forEach((el) => el.nextElementSibling.classList.add("d-none"));
        for (const key in err) {
            formInputs.forEach((el) => {
                if (el.name === key) {
                    el.nextElementSibling.classList.remove("d-none");
                    el.nextElementSibling.textContent = err[key];
                }
            });
        }
    }
}

export default FormSubmit
