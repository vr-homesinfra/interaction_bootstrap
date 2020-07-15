$(document).ready(function() {

	
	$('.button_holder').on('click', function() {
		document.search_form.submit();
	})

});


$(document).click(function(e){

	if(e.target.class != "search_results" && e.target.id != "search_text_input") {

		$(".search_results").html("");
		$("#profile_location").html("");
		$('.search_results_footer').html("");
		$('.search_results_footer').toggleClass("search_results_footer_empty");
		$('.search_results_footer').toggleClass("search_results_footer");
	}

	// if(e.target.className != "dropdown_data_window") {

	// 	$(".dropdown_data_window").html("");
	// 	$(".dropdown_data_window").css({"padding" : "0px", "height" : "0px"});
	// }


});

// function getUsers(value, user) {
// 	$.post("includes/handlers/ajax_friend_search.php", {query:value, userLoggedIn:user}, function(data) {
// 		$(".results").html(data);
// 	});
// }

function getDropdownData(user, type) {

	if($(".dropdown_data_window.show").length <= 0) {
		var pageName;

		if(type == 'notification') {
			pageName = "ajax_load_notifications.php";
			$("span").remove("#unread_notification");
		}
		else if (type == 'message') {
			pageName = "ajax_load_messages.php";
			$("span").remove("#unread_message");
		}

		var ajaxreq = $.ajax({
			url: "includes/handlers/" + pageName,
			type: "POST",
			data: "page=1&userLoggedIn=" + user,
			cache: false,

			success: function(response) {
				$(".dropdown_data_window").html(response);
				//$(".dropdown_data_window").removeClass('show');
				$("#dropdown_data_type").val(type);
			}

		});
	}else if($(".dropdown_data_window.show").length > 0) {
		$(".dropdown_data_window").html(" ");
	}

}


function getExtLiveSearchUsers(value) {

	$.post("includes/handlers/ajaxCitySearch.php", {query:value}, function(data) {

		 if($(".search_results_footer_empty")[0]) {
			$(".search_results_footer_empty").toggleClass("search_results_footer");
			$(".search_results_footer_empty").toggleClass("search_results_footer_empty");
		}

		$('.search_results').html(data);
		$('.search_results_footer').html("<a href='ajaxCitySearch.php?q=" + value + "'>See All Results</a>");

		if(data == "") {
			$('.search_results_footer').html("");
			$('.search_results_footer').toggleClass("search_results_footer_empty");
			$('.search_results_footer').toggleClass("search_results_footer");
		}

	});

}
function getExtLiveLoadLocation(value) {

	$.post("includes/handlers/ajaxCitySearch.php", {query:value}, function(data) {
		$('#profile_location').html(data);
	});

}
function getExtLiveSearchImg(value) {

	$.post("includes/handlers/ajaxCitySearch.php", {query:value}, function(data) {

		 if($(".search_results_footer_empty")[0]) {
			$(".search_results_footer_empty").toggleClass("search_results_footer");
			$(".search_results_footer_empty").toggleClass("search_results_footer_empty");
		}

		$('.search_results').html(data);
		$('.search_results_footer').html("<a href='ajaxCitySearch.php?q=" + value + "'>See All Results</a>");

		if(data == "") {
			$('.search_results_footer').html("");
			$('.search_results_footer').toggleClass("search_results_footer_empty");
			$('.search_results_footer').toggleClass("search_results_footer");
		}

	});

}







