// document.addEventListener('DOMContentLoaded', function() {
//     let formCount = parseInt(document.getElementById('formCount').value);
//     const maxFilters = 4;

//     function updateFormCount() {
//         document.getElementById('formCount').value = formCount;
//     }

//     document.querySelector('.add-filter').addEventListener('click', function() {
//         if (formCount < maxFilters) {
//             formCount++;
//             const newFilter = document.querySelector('.filter-group').cloneNode(true);
//             newFilter.id = `filter_${formCount - 1}`;
//             newFilter.querySelectorAll('select, input').forEach(function(input) {
//                 const name = input.getAttribute('name');
//                 const id = input.getAttribute('id');
//                 const newName = name.replace(/\[\d+\]/, `[${formCount - 1}]`);
//                 const newId = id.replace(/\d+$/, formCount - 1);
//                 input.setAttribute('name', newName);
//                 input.setAttribute('id', newId);
//                 input.value = '';
//             });
//             newFilter.querySelector('.remove-filter').id = formCount - 1;
//             newFilter.style.display = 'block';
//             document.getElementById('search-form').insertBefore(newFilter, document.querySelector('.add-filter').parentElement);
//             updateFormCount();
//         }
//     });

//     document.getElementById('search-form').addEventListener('click', function(event) {
//         if (event.target.classList.contains('remove-filter')) {
//             const filterId = event.target.id;
//             document.getElementById(`filter_${filterId}`).remove();
//             formCount--;
//             updateFormCount();
//         }
//     });

//     document.querySelectorAll('.search_in').forEach(function(select) {
//         select.addEventListener('change', function() {
//             const filterId = this.dataset.id;
//             const dateRangeGroup = document.querySelector(`#filter_${filterId} .date-range-group`);
//             const blockFlagGroup = document.querySelector(`#filter_${filterId} .block-flag-group`);

//             if (this.value === 'created_datetime') {
//                 dateRangeGroup.style.display = 'block';
//                 blockFlagGroup.style.display = 'none';
//             } else if (this.value === 'block_flag') {
//                 blockFlagGroup.style.display = 'block';
//                 dateRangeGroup.style.display = 'none';
//             } else {
//                 dateRangeGroup.style.display = 'none';
//                 blockFlagGroup.style.display = 'none';
//             }
//         });
//     });

//     document.querySelectorAll('.date_range').forEach(function(input) {
//         $(input).daterangepicker({
//             autoUpdateInput: false,
//             locale: {
//                 cancelLabel: 'Clear'
//             }
//         });

//         $(input).on('apply.daterangepicker', function(ev, picker) {
//             $(this).val(picker.startDate.format('MM/DD/YYYY') + ' ~ ' + picker.endDate.format('MM/DD/YYYY'));
//         });

//         $(input).on('cancel.daterangepicker', function(ev, picker) {
//             $(this).val('');
//         });
//     });
// });


// start script for search
$(document).ready(function (){    
var divsToShow = $('#divToShow').val().split(',');

for (i = 0; i <= divsToShow.length; i++) {

      $('#filter_' + divsToShow[i]).show();
}

$(document).on('change', '.search_in', function() {
    var id = $(this).attr('data-id');
    var search_in = $('#search_in_' + id).val();
    showHideSpan(search_in, id);
});

var formCount = $('#formCount').val();

for (i = 0; i <= 3; i++) {
        var search_in = $('#search_in_' + i).val();
        showHideSpan(search_in, i);
}

if (formCount == 4) {
    $('.add-filter').attr('disabled', 'true');
}

$(document).on('click', '.add-filter', function() {
var formCount = $('#formCount').val();

if (formCount < 4) {

    formCount++;
    $('#formCount').val(formCount);

    if (formCount == 4) {
        $('.add-filter').attr('disabled', 'true');
    }

    var divToShow = $('#divToShow').val();

    var divArrayToShow = divToShow.split(',');

    for (i = 0; i <= 4; i++) {

        if ($('#filter_' + i).is(":visible")) {

        } else {

            $('#filter_' + i).show();

            if (jQuery.inArray(i, divArrayToShow) == -1) {

                if (divToShow != '') {
                    $('#divToShow').val(divToShow + ',' + i);
                } else {
                    $('#divToShow').val(i);
                }
            }

            return false;
        }
    }
}

});


$(document).on('click', '.remove-filter', function() {
var index = $(this).attr('id');
$('#filter_' + index).hide();
var formCount = $('#formCount').val();
formCount--;

var divString = $('#divToShow').val();

var divArrayToHide = divString.split(',');

var divArrayToHide = jQuery.grep(divArrayToHide, function(value) {
    return value != index;
});

var divStringToHide = divArrayToHide.toString();
$('#divToShow').val(divStringToHide);
$('#formCount').val(formCount);

$('.add-filter').removeAttr('disabled');
$('#user_type_' + i).val('Any').change();
//$('#active_flag_'+i).val('Any').change();
$('#block_flag_' + i).val('Any').change();
//   $('#report_flag_'+i).val('Any').change();
$('.date_range' + index).val('');
$('.suggestion_text' + index).val('');
});
// end script for search
});


$(function() {

for (i = 0; i <= 3; i++) {

$('.date_range' + i).daterangepicker({
    autoUpdateInput: false,
    locale: {
        cancelLabel: 'Clear',
        //format: 'DD-MM-YYYY'
        format: 'MM/DD/YYYY'
    }
});

$('.date_range' + i).on('apply.daterangepicker', function(ev, picker) {
    //$(this).val(picker.startDate.format('DD-MM-YYYY') + ' ~ ' + picker.endDate.format('DD-MM-YYYY'));
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' ~ ' + picker.endDate.format('MM/DD/YYYY'));
});

$('.date_range' + i).on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
}

});


function showHideSpan(search_in, i) {

if (search_in == 'user_name' || search_in == 'email_id' || search_in=='phone_number')  {
$('#suggestion_text_span_' + i).css('display', 'block');
$('#search_type' + i).removeAttr("disabled");
$('#search_type_' + i).prop('disabled', false);
$('.suggestion_text_' + i).removeAttr("onkeyup", "checkInput(this)");
// $('#block_flag_span_' + i).css('display', 'none');
$('#block_flag_' + i).val('Any');
$('#sign_via_span_' + i).css('display', 'none');
// $('#gender_flag_span_' + i).val('Any');
// $('#user_type_span_' + i).css('display', 'none');
// $('#user_type' + i).val('Any');
// $('#report_flag_span_' + i).css('display', 'none');
// $('#report_flag_' + i).val('Any');
$('#date_range_span_' + i).css('display', 'none');
$('.date_range' + i).val('');
// $('#is_verified_span_' + i).css('display', 'none');
// $('#is_verified' + i).val('Any');
// $('#vendor_type_span_' + i).css('display', 'none');

} else if (search_in == 'created_datetime') {
$('#block_flag_span_' + i).css('display', 'none');
$('#block_flag_' + i).val('Any');
// $('#gender_flag_span_' + i).css('display', 'none');
// $('#gender_flag_span_' + i).val('Any');
$('#date_range_span_' + i).css('display', 'block');
$('#search_type_' + i).attr('disabled', 'disabled');
$('.suggestion_text' + i).removeAttr("onkeyup", "checkInput(this)");
$('#search_type_' + i).val('exact_match').change();
// $('#user_type_span_' + i).css('display', 'none');
// $('#user_type' + i).val('Any');
$('#suggestion_text_span_' + i).css('display', 'none');
$('#is_verified_span_' + i).css('display', 'none');
$('#is_verified' + i).val('Any');
// $('#vendor_type_span_' + i).css('display', 'none');
} else if (search_in == 'block_flag') {
$('#user_type_span_' + i).css('display', 'none');
$('#user_type' + i).val('Any');
$('#sign_via_span_' + i).css('display', 'none');
$('#sign_via_span_' + i).val('Any');
$('#block_flag_span_' + i).css('display', 'block');
$('#search_type_' + i).prop('disabled', true);
$('.suggestion_text_' + i).removeAttr("onkeyup", "checkInput(this)");
$('#search_type_' + i).val('exact_match').change();
$('#suggestion_text_span_' + i).css('display', 'none');
$('#suggestion_venue_' + i).val('');
$('.date_range' + i).val('');
$('#date_range_span_' + i).css('display', 'none');
// $('#active_flag_span_' + i).css('display', 'none');
// $('#active_flag' + i).val('Any');
// $('#vendor_type_span_' + i).css('display', 'none');

//    $('#search_type_'+i).val('exact_match').css('cursor', 'not-allowed');
//$('#search_type_'+i).css('cursor', 'not-allowed');
} else if (search_in == 'is_verified') {
$('#user_type_span_' + i).css('display', 'none');
$('#user_type' + i).val('Any');
$('#is_verified_span_' + i).css('display', 'block');
// $('#block_flag_span_' + i).css('display', 'none');
// $('#block_flag_' + i).val('Any');
// $('#gender_flag_span_' + i).css('display', 'none');
// $('#gender_flag_span_' + i).val('Any');
$('#search_type_' + i).prop('disabled', true);
$('.suggestion_text_' + i).removeAttr("onkeyup", "checkInput(this)");
$('#search_type_' + i).val('exact_match').change();
$('#suggestion_text_span_' + i).css('display', 'none');
$('.date_range' + i).val('');
$('#date_range_span_' + i).css('display', 'none');
$('#date_range_span_' + i).css('display', 'none');
// $('#vendor_type_span_' + i).css('display', 'none');

} else if (search_in == 'sign_via'){
$('#user_type_span_' + i).css('display', 'none');
$('#user_type' + i).val('Any');
$('#sign_via_span_' + i).css('display', 'block');
$('#sign_via_span_' + i).val('Any');
$('#block_flag_span_' + i).css('display', 'none');
$('#search_type_' + i).prop('disabled', true);
$('.suggestion_text_' + i).removeAttr("onkeyup", "checkInput(this)");
$('#search_type_' + i).val('exact_match').change();
$('#suggestion_text_span_' + i).css('display', 'none');
$('#suggestion_venue_' + i).val('');
$('.date_range' + i).val('');
$('#date_range_span_' + i).css('display', 'none');
}

}

