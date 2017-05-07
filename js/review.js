$(document).ready(function() {

	
	
	$('body').on('click', '.deleteReview', function() {

		var reviewId = $(this).data("reviewid");
		var listReview = $(this).parent();


		request = $.ajax({
			url: "ajax/removeReviewFromList.php",
			type: "post",
			data: { reviewid : reviewId}
		});


		request.done(function (response, textStatus, jqXHR){
			listReview.remove();
			location.reload();
		});
		



	});

});