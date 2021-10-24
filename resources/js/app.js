require('bootstrap');
require('datatables.net');

import './libs/trix.js';
import $ from 'jquery';

window.$ = window.jQuery = $;

$(document).ready(function () {
    $('#control-table').DataTable({
        columnDefs: [
            {orderable: false, targets: 4}
        ]
    });
});

document.addEventListener("trix-file-accept", function(event) {
    event.preventDefault();
});
