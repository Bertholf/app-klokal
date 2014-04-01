
$(document).ready(function(){
	$.getJSON('/getTags', function(data){
		$('#tag_list .typeahead').typeahead({ 
			source:data,
		});
	});
	
	$('#select_tag').click(function(){
		var myVal = $('.typeahead').typeahead();
		var tag_title =  myVal.prop('value');
		var userId = $('#userId').attr('value');
		var twitterHandle = $('#twitterHandle').attr('value');
		$('#update_tag').attr('action',"/tag/updatebytitle/"+twitterHandle+"/"+userId+"/"+tag_title)
	});
});

