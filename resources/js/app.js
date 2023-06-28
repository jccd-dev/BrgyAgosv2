import $ from 'jquery'
import './bootstrap';
import './utils/date_picker'
import './dashboard/addprofile'
import './dashboard/importExcel'
import './login'
import get_profile from './dashboard/getprofile'


import {initializeDataTable} from './utils/datatable';

$(()=> {
    get_profile().then(data => {
        initializeDataTable(data)
    }).catch(error => {console.log(error)})
})
