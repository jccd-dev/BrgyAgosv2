import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
import 'bootstrap-datepicker'
import $ from 'jquery'

// find the datepicker input using class
$('.datepicker').datepicker({
    format: 'yyyy/mm/dd'
});
