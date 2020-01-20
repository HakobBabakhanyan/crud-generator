window.$ = window.jQuery = require('jquery');
import 'jquery-ui-sortable-npm/jquery-ui-sortable.min';
window.Chart = require('./vendor/chart.js/Chart.bundle');

import 'dropify/dist/js/dropify';
// import 'jquery/dist'
import 'dropify/dist/js/dropify';
import './vendor/bootstrap/js/bootstrap.bundle.min';
import './vendor/jquery-easing/jquery.easing.min';
import 'select2/dist/js/select2.min'



window.BaseUrl = window.origin;

window.Swal = require('sweetalert2/dist/sweetalert2.min');

window.csrf = $('meta[name=csrf-token]').attr("content");

import 'bootstrap-datepicker/js/bootstrap-datepicker';
$.fn.datepicker.defaults.format = "dd.mm.yyyy";
$(function() {
    $('.datapicker').datepicker({
    });
});

require('./vendor/select2/select2');
require('datatables.net-bs4');

require( './sb-admin/sb-admin-2');

require('./chart.js');

require('./datatables');

require('./file');

require('./toastr');

require('./sortable');

let element_delete = $('[data-delete=true]');
if(element_delete.length){
    element_delete.submit(function (e) {
        let _this = $(this);
        e.preventDefault();
        Swal.fire({
            type: 'warning',
            title:'delete ?',
            showCancelButton:true,
            confirmButtonText:'ok',
            cancelButtonText:'cancel',
            preConfirm:(elem)=>{
                e.currentTarget.submit()
            },
        })
    })
}


let accordionSidebar = $('#accordionSidebar');
let accordionSidebarSearch = $('#accordionSidebarSearch');
if(accordionSidebar.length && accordionSidebarSearch.length){
        accordionSidebarSearch.on('keyup',function () {
            let elements = accordionSidebar.find('.nav-item');
            let text = $(this).val().toLowerCase();
            if(text !== ''){
                elements.each(function() {
                    if(($( this ).find('span').text().toLowerCase().includes(text))){
                        $(this).removeClass('hide_search');
                    }else {
                        $(this).addClass('hide_search');
                    }
                });
            }else {
                elements.removeClass('hide_search');
            }

        })
}
