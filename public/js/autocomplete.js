
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

//	$("#add_list_to_user .typeahead").typeahead({
//	    onSelect: function(item) {
//	        console.log(item);
//	    },
//	    ajax: {
//	        url: "/lists/select",
//	        timeout: 500,
//	        displayField: "title",
//	        triggerLength: 1,
//	        method: "get",
//	        loadingClass: "loading-circle",
//	        preDispatch: function (query) {
//	            return {
//	                search: query
//	            }
//	        },
//	        
//	        preProcess: function (data) {
//	        	console.log(data);
//	            showLoadingMask(false);
//	            if (data.success === false) {
//	                alert(1)
//	                return false;
//	            }
//	            alert(2);
//	            return data.mylist;
//	        }
//	    }
//	});
	
	$('#show_add_content').click(function(){
		if($('.show_add_list').css('visibility') == 'hidden')
		{
			$('.show_add_list').css('visibility','visible');
			$(this).children('.icon-pencil-text').text('Close Create Form');
		}else if($('.show_add_list').css('visibility') == 'visible')
		{
			$('.show_add_list').css('visibility','hidden');
			$(this).children('.icon-pencil-text').text('Create your own list');
		}
	});
});

