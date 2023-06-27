import $ from 'jquery';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'
import 'datatables.net/js/jquery.dataTables'
import 'datatables.net-bs5/js/dataTables.bootstrap5'
import axios from 'axios';

export function initializeDataTable(pdata){
    let dataTable
    dataTable = $('#example').DataTable({
        data: pdata,
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return `${row.fname} ${row.mname} ${row.lname} ${row.suffix ?? ''}`;
                }
            },
            { data: 'sex'},
            { data: 'cstatus'},
            { data: 'zone'},
            { data: 'age'},
            { data: 'pwd'},
            { data: 'senior'},
            { data: 'deseased'}
        ],
        columnDefs :[
            {width: '260px', target: 0},
            {width: '200px', target: 2},
            {width: '80px', target: 3},
            {width: '50px', target: 4},
            {width: '55px', target: 5},
            {width: '55px', target: 6},
            {width: '70px', target: 7},
        ]


      });

      // Add filter input
      $('#example_filter').append('<input type="text" id="name-filter" class="form-control form-control-sm" placeholder="Name" aria-controls="example">');
      $('#example_filter').append('<input type="number" id="zone-filter" class="form-control form-control-sm custom-input" placeholder="Zone" aria-controls="example">');

      // Apply filter on keyup
      $('#name-filter').on('keyup', function () {
        dataTable.columns(0).search(this.value).draw();
      });
      $('#zone-filter').on('keyup', function () {
        dataTable.columns(3).search(this.value).draw();
      });

      $('#example tbody').on('mouseenter', 'tr', function () {
        // $(this).removeClass('odd');
        $(this).addClass('table-primary');
      }).on('mouseleave', 'tr', function () {
        $(this).removeClass('table-primary');
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


