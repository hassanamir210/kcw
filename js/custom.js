$(document).ready( function () {

    $('.table-striped-').DataTable( {
        paging: true,
        scrollX:true,
        order: [] ,
        pageLength: 25
    } );

    $('#close-sidebar').on('click', function() {
        $('#kt_aside').attr('style', 'width: 0px !important');
    });

    $('#open-sidebar').on('click', function() {
        $('#kt_aside').attr('style', 'width: 250px !important');
    });
} );