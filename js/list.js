$(document).ready(function() {
	
	$('#addproduct').click(function() {

		var itemName_input = $('#product').val();
		var listid_input = $('#listid').val();


		$('#product, #addproduct').prop("disabled", true);


		request = $.ajax({
			url: "ajax/addItemsToList.php",
			type: "post",
			data: { listid : listid_input, itemName : itemName_input}
		});


		request.done(function (response, textStatus, jqXHR){
			$("#todoList").append('<li>'+itemName_input+'</li>');
			$('#product').val("");
		});


	    request.always(function () {
	        $('#product, #addproduct').prop("disabled", false);
	    });

	});
	
	$('.deleteItem').click(function() {

		var itemId = $(this).data("itemid");
		var listItem = $(this).parent();


		request = $.ajax({
			url: "ajax/removeItemsFromList.php",
			type: "post",
			data: { itemid : itemId}
		});


		request.done(function (response, textStatus, jqXHR){
			$("#ReviewList").append('<li>'+itemName_input+'</li>');
		});




	});

});
function myFunction() {
   		 document.getElementById("myDropdown").classList.toggle("show");
	}
window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {
		
		    var dropdowns = document.getElementsByClassName("dropdown-content");
		    var i;
		    for (i = 0; i < dropdowns.length; i++) {
		      var openDropdown = dropdowns[i];
		      if (openDropdown.classList.contains('show')) {
		        openDropdown.classList.remove('show');
		      }
		    }
		  }
}