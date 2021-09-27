require('bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;
require('datatables.net');

$(document).ready(function () {
    $('#control-table').DataTable({
        columnDefs: [
            {orderable: false, targets: 4}
        ]
    });
});
