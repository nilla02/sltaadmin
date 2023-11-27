// Call the dataTables jQuery plugin

$(document).ready(function() {
  $('#dataTable').DataTable( {
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
  } );
} );

$(document).ready(function() {
  $('#EDCard-accommodation-range').DataTable( {
      "order": [[ 6, "desc" ]],
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
  } );
} );

$(document).ready(function() {
  $('#accommodation').DataTable( {
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
    "order": [[ 6, "asc" ]],
  } );
} );

$(document).ready(function() {
  $('#property-accommodation').DataTable( {
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, "All"] ],
    "order": [[ 6, "asc" ]],
  } );
} );

$(document).ready(function() {
  $('#levy-accommodation').DataTable( {
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
    "order": [[ 5, "asc" ]],
  } );
} );

$(document).ready(function() {
  $('#payment').DataTable( {
    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
    "order": [[ 8, "asc" ]],
  } );
} );