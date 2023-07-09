// remove error message when user change the value,
// but brings it back when user delete the value

export const clearForm = (formElements) => {
    formElements.forEach(element => {

        // only for datepicker --start
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

            let age = document.querySelector('#age')
            age.nextElementSibling.classList.add("d-none");
        })
        // only for datepicker --end

        element.addEventListener('input', (e) => {
            element.nextElementSibling.classList.add("d-none");
            if(element.value.trim() === ''){
                element.nextElementSibling.classList.remove("d-none");
            }
        })

    })
}

// export default clearForm

