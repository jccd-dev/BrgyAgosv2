import 'bootstrap-datepicker/dist/css/datepicker.css'
import 'bootstrap-datepicker'
import $ from 'jquery'

// find the datepicker input using class
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy'
});
