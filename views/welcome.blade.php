<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src=//stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js></script>
  </head>
  <body >
    <div >
      <a href=" {{ ('create')}}"   >ADD product</a>
      <div >
        <div >
          <h1 id="title"></h1>
          <p id="description"></p>
        </h1>
        <div ></div>
      </div>
    </div>
    <table class="table" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Qty</th>
      <th scope="col">Discount Type</th>
      <th scope="col">Discount</th>
      <th scope="col">Total</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody id="product-info">
 
    
  </tbody>
</table>
    <script
    src=//code.jquery.com/jquery-3.5.1.min.js
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin=anonymous></script>
    <script type=text/javascript>
    //-------------------select----------------
     $(document).ready(function() {
      // $("#getData").click(function() {
          
          $.get("{{URL::to ('prolist') }}",function(data){
           $('#product-info').empty().html(data);
          //  console.log(data)
          }); 
          });



// ----------------------delete---------------------
         $(document).on('click','#del',function(e){
          
        var id= $(this).data('id');
       
       var url = "{{URL('delete')}}";
      var deleteproduct = url +"/"+ id;
      var r = confirm("Are You Sure !");
if (r == true) {
 
		$.ajax({
			url:deleteproduct ,
			type: "post",
			cache: false,
			data:{
				_token:'{{ csrf_token() }}'
			},
			success: function(dataResult){
		
				if(dataResult==0){
          alert('Product Not Deleted');
				}else{
          alert(' Product Deleted successfully');
          window.location = "{{URL('index')}}";
        }
			}
		});
  }
  else{
    
  }
  });
      
        

      </script>


  </body>
</html>