// remove error message when user change the value,
// but brings it back when user delete the value

const clearForm = (formElements) => {
    formElements.forEach(element => {

        // only for datepicker
        element.addEventListener('focus', ()=>{
            if(element.className == 'form-control datepicker' || element.className == 'form-control file'){
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
}

export default clearForm

