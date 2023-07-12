import $ from 'jquery';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'
import 'datatables.net/js/jquery.dataTables'
import 'datatables.net-bs5/js/dataTables.bootstrap5'

export function initializeDataTable(fdata){
    let dataTable
    dataTable = $('#example').DataTable({
        data: fdata,
        columns: [
            { data: 'id'},
            { data: 'family_name'},
            { data: 'house_ownership'},
        ],
        columnDefs :[
            {width: '50px', target: 0}, // id
            {width: '150px', target: 1}, // family name
            {width: '150px', target: 2}, // ownership
        ]


      });

      $('#example_length').parent('.col-sm-12').removeClass('col-sm-12 col-md-6').addClass('col-sm-6 col-md-4')
      $('#example_filter').parent('.col-sm-12').removeClass('col-sm-12 col-md-6').addClass('col justify-content-end')

      // Add filter input
    //   $('#example_filter').append('<input type="text" id="CR-filter" class="form-control form-control-sm custom-input" placeholder="CR" aria-controls="example">');
    //   $('#example_filter').append('<input type="text" id="electricity-filter" class="form-control form-control-sm custom-input" placeholder="Electricity" aria-controls="example">');
      $('#example_filter').append('<input type="text" id="ownership" class="form-control form-control-sm w-25" placeholder="Ownership" aria-controls="example">');

      // Apply filter on keyup
      $('#ownership').on('keyup', function () {
        dataTable.columns(2).search(this.value).draw();
      });
    //   $('#electricity-filter').on('keyup', function () {
    //     dataTable.columns(3).search(this.value).draw();
    //   });
    //   $('#water-filter').on('keyup', function () {
    //     dataTable.columns(4).search(this.value).draw();
    //   });

      $('#example tbody').on('mouseenter', 'tr', function () {
        // $(this).removeClass('odd');
        $(this).addClass('table-primary');
      }).on('mouseleave', 'tr', function () {
        $(this).removeClass('table-primary');
      });

      dataTable.on('dblclick', 'tr', function () {
        // Get the data of the clicked row
        var rowData = dataTable.row(this).data();

        // Assuming you have a unique identifier for each row, e.g., 'id'
        var rowId = rowData.id;

        // Perform the navigation to the full page using the rowId
        window.location.href = '/dashboard/update-family/' + rowId; // Replace with your actual full page URL
      });
}

export function updateDataTableData(data){
    var dataTable = $('#example').DataTable();

    // Clear existing data
    dataTable.clear();

    // Add new data
    dataTable.rows.add(data);

    // Redraw the DataTable
    dataTable.draw();
}


