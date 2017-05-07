$(document).ready(function() {

	$('#addcomment').click(function() {
	
			var comment_input = $('#comment').val();
			var restaurantid_input = $('#restaurantid').val();
			var star_input=$('#rating').val();
			var img=$('#img').val();
			var id=$('#userid').val();
			var name=$('#username').val();
        
			$('#comment, #addcomment').prop("disabled", true);
	
	
			request = $.ajax({
				url: "ajax/addReviewsToList.php",
				type: "post",
				data: { restaurantid: restaurantid_input , comment: comment_input, star: star_input}
			});
	
	if(comment_input!=null&&comment_input!=""){
			request.done(function (response, textStatus, jqXHR){
            
			$("#Restaurant_List").append('<div>  <div class="userImg" ><img class="profileImage" src="./user_images/'+img+'"/><br><p>User'+id+':'+name+'</p></div> <div class="userCommet"><h2>Score:'+star_input+'</h2>'+comment_input +'</div> <div style="clear: both;"></div>   </div>	');
			
			$('#comment').val("");
			});
	}
	
		    request.always(function () {
		        $('#comment, #addcomment').prop("disabled", false);
		    });
	
		});


});