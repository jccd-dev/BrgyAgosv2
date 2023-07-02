import axios from "axios";
import $ from 'jquery';
import Swal from "sweetalert2";

$(()=> {
    $('#adminSetting').on('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const res = await axios.post('/dashboard/update-admin', formData)
            if(res.status === 200){
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
                    title: res.data.success
                  }).then(()=>{
                    $('#adminSetting')[0].reset()
                  })
            }
        } catch (error) {
            if(error.response.status === 420){
                updateError(error)
                errorHanlder(error?.response.data.errors);
            }
            errorHanlder(error?.response.data.errors);
        }

    });

    const errorHanlder = (err) =>{
        for (const key in err) {
            $('input').each(function() {
                if ($(this).attr('name') === key) {
                  $(this).next().removeClass('d-none')
                  $(this).next().text(err[key]);

                  $(this).on('keydown', ()=>{
                    $(this).next().addClass('d-none')
                    if($(this).val().trim() === ''){
                        $(this).next().removeClass('d-none')
                    }
                  })
                }
            });
        }
    }
    const updateError = (err) =>{
        Swal.fire(
            'Invalid Login!',
            err.response.data.errors,
            'warning'
          )
    }

})
