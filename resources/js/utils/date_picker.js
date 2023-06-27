import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
import 'bootstrap-datepicker'
import $ from 'jquery'
import moment from 'moment'


// find the datepicker input using class
$('.datepicker').datepicker({
    format: 'yyyy/mm/dd'
})

$('.datepicker').on('changeDate, change', (event)=>{

    const dateOfBirth = $(event.target).val();

    // Get the current date
    const currentDate = moment();
    const formattedDate = moment(dateOfBirth, 'YYYY-MM-DD');
    // Calculate the age based on the difference between the current date and the birthdate
    const age = currentDate.diff(formattedDate, 'years');

    $('#age').val(age)
})
