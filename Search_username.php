<html>
    </<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
    </head>
    <body>
       <!-- This is the nav bar on top of the screen -->
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
      	      <!-- <a class="navbar-brand" href="../warehouse.php"><img src="../../images/logo.png" width="65" height="65" class="d-inline-block align-top" alt=""></a> -->

      	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      	        <span class="navbar-toggler-icon"></span>
      	      </button>

      	      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      	        <ul class="navbar-nav mr-auto">
      	            <li class="nav-item active">
      	                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      	            </li>
      	      <li class="nav-item">
      	        <a class="nav-link" href="#">Logout</a>
      	      </li>
      	      <li class="nav-item">
      	        <a class="nav-link" href="#">About Us</a>
      	      </li>
      	      </li>
      	        </ul>
      	    </nav>
			  <div class="container">
   			  <h3 allign="center">Welcome User!</h3>
   			  <br /><br />
			  <!-- Not sure if i should add a button... -->
   			  <div id="search_area">
    		    	<input type="text" name="user_search" id="user_search" class="form-control input-lg" autocomplete="off" placeholder="Search User" />
   			  </div>
				 <br />
   				 <br />
   			  <div id="user_data"></div>
			</div>
    </body>
</html>

<!-- This handles all incoming data -->
<script>
$(document).ready(function(){
 
 load_data('');
 
 function load_data(query, typehead_search = 'yes')
 {
  $.ajax({
   url:"fetch_user.php",
   method:"POST",
   data:{query:query, typehead_search:typehead_search},
   success:function(data)
   {
    $('#user_data').html(data);
   }
  });
 }
 
 $('#user_search').typeahead({
  source: function(query, result){
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data){
     result($.map(data, function(item){
      return item;
     }));
     load_data(query, 'yes');
    }
   });
  }
 });
 
 $(document).on('click', 'li', function(){
  var query = $(this).text();
  load_data(query);
 });
 
});
</script>