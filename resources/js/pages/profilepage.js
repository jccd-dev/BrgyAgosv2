import $ from 'jquery'
import Swal from 'sweetalert2'
import '../utils/date_picker'
import '../dashboard/addprofile'
import '../dashboard/importExcel'

import {get_profile} from '../dashboard/get-data'
import { initializeDataTable } from '../utils/datatable'

$(()=> {
    get_profile().then(data => {
        initializeDataTable(data)
    }).catch(error => {console.log(error)})

    $('#export').on('click', () => {
        Swal.fire({
            title: 'Export Profiles',
            text: "It will export an excel file",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Download it'
          }).then((result) => {
            if (result.isConfirmed) {
                window.open('/dashboard/export')
                Swal.fire(
                    'Downloaded!',
                    'Your file has been Downloaded',
                    'success'
                  )
            }
          })
    })
})
