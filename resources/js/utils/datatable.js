import $ from 'jquery';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'
import 'datatables.net/js/jquery.dataTables'
import 'datatables.net-bs5/js/dataTables.bootstrap5'

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
            {
                data: null,
                render: function (data, type, row) {
                    if(row.pwd != null){
                        return `<i class="fa-solid fa-circle text-teal"></i>`;
                    }
                    return ''
                },
                className: 'text-center'
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(row.senior != null){
                        return `<i class="fa-solid fa-circle text-teal"></i>`;
                    }
                    return ''
                },
                className: 'text-center'
            },
            // { data: 'deseased'}
            {
                data: null,
                render: function (data, type, row) {
                    if(row.deseased != null){
                        return `<i class="fa-solid fa-circle text-teal"></i>`;
                    }
                    return ''
                },
                className: 'text-center'
            },
        ],
        columnDefs :[
            {width: '270px', target: 0}, // name
            {width: '60px', target: 1}, // sex
            {width: '100px', target: 2}, //civil status
            {width: '70px', target: 3}, //zone
            {width: '50px', target: 4}, //age
            {width: '55px', target: 5}, //pwd
            {width: '55px', target: 6},// senior
            {width: '70px', target: 7}, //other
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

      dataTable.on('dblclick', 'tr', function () {
        // Get the data of the clicked row
        var rowData = dataTable.row(this).data();

        // Assuming you have a unique identifier for each row, e.g., 'id'
        var rowId = rowData.id;

        // Perform the navigation to the full page using the rowId
        window.location.href = '/dashboard/update/' + rowId; // Replace with your actual full page URL
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


