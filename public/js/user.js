$(function(){

	$('#toggle-location').click(function(){
	    var $this = $(this);
	    $this.hide();
	    $('#location-filter').collapse('show');
  	});

  	$('#close-location').click(function(){
	    var $this = $(this);
	    $this.collapse('hide');
	    $('#location-filter').collapse('hide');
	    $('#toggle-location').show();
  	});

});