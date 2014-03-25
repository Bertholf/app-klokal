(function () {
	$(document).ready(function(){

$('input[type=file]').bootstrapFileInput();
$('.file-inputs').bootstrapFileInput();
  


//Fix Jquery Validation plugin for Bootstrap 3
if (jQuery.validator) {
  jQuery.validator.setDefaults({
    debug: true,
    errorClass: 'has-error',
    validClass: 'has-success',
    ignore: "",
    highlight: function (element, errorClass, validClass) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
      $(element).closest('.form-group').find('.help-block').text('');
    },
    errorPlacement: function (error, element) {
      $(element).closest('.form-group').find('.help-block').text(error.text());
    },
    submitHandler: function (form) {
      if ($(form).valid()) {
        form.submit();
      }
    }
  });
}



  $('#disclaimer').popover(
  {
     trigger: 'hover',
     html: true,
     placement: 'right',
     content: 'hello world'
  });




this.setDataTable = function(selector) {
    if (jQuery().dataTable) {
      return selector.each(function(i, elem) {
        var dt, sdom;
        if ($(elem).data("pagination-top-bottom") === true) {
          sdom = "<'row datatables-top'<'col-sm-6'l><'col-sm-6 text-right'pf>r>t<'row datatables-bottom'<'col-sm-6'i><'col-sm-6 text-right'p>>";
        } else if ($(elem).data("pagination-top") === true) {
          sdom = "<'row datatables-top'<'col-sm-6'l><'col-sm-6 text-right'pf>r>t<'row datatables-bottom'<'col-sm-6'i><'col-sm-6 text-right'>>";
        } else {
          sdom = "<'row datatables-top'<'col-sm-6'l><'col-sm-6 text-right'f>r>t<'row datatables-bottom'<'col-sm-6'i><'col-sm-6 text-right'p>>";
        }
        dt = $(elem).dataTable({
          sDom: sdom,
          sPaginationType: "bootstrap",
          "iDisplayLength": $(elem).data("pagination-records") || 10,
          oLanguage: {
            sLengthMenu: "_MENU_ records per page"
          }
        });
        if ($(elem).hasClass("data-table-column-filter")) {
          dt.columnFilter();
        }
        dt.closest('.dataTables_wrapper').find('div[id$=_filter] input').css("width", "200px");
        return dt.closest('.dataTables_wrapper').find('input').addClass("form-control input-sm").attr('placeholder', 'Search');
      });
    }
  };


});

}).call(this);