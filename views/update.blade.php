<!DOCTYPE html>
<html>
<head>
<a href="{{url('index')}}"   >Product List</a>

	<title>update data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<center><h1> Update Product </h1></center>
<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="{{ $data[0]->id }}" >
    
		<div class="form-group">
			<label for="email">Product Name:</label>
			<input type="text" class="form-control" id="name" value="{{ $data[0]->name }}" placeholder="Name" name="name">
			<span  style="color: red;" id="productname_error_message"></span><br><br>
		</div>
		<div class="form-group">
			<label for="email">Product Image:</label>
			<input type="file" id="productimg" name="productimg" accept="image/*" >
			<span  style="color: red;" id="productimg_error_message"></span><br><br>
		
			<img src="{{url('productimg')}}/{{ $data[0]->productimg  }}" id="img" name="img"  height="50px"> </img>
		</div>
		<div class="form-group">
			<label for="email">Product Price:</label>
			<input type="text" class="form-control" id="price" value="{{ $data[0]->price }}" placeholder="Price" name="price" onkeypress="return isNumber(event)">
			<span  style="color: red;" id="price_error_message"></span><br><br>
		</div>
		<div class="form-group">
			<label for="email">Description:</label>
			<textarea class="form-control" id="desc"  placeholder="Description..." name="desc">{{ $data[0]->desc }}</textarea>
			<span  style="color: red;" id="desc_error_message"></span><br><br>
		</div>
		<div class="form-group">
			<label for="pwd">Qty:</label>
			<input type="number" class="form-control" id="qty" value="{{ $data[0]->qty }}" placeholder="Quantity" name="qty" min="0">
			<span  style="color: red;" id="qty_error_message"></span><br><br>
		</div>
		<div class="form-group" >
			<label for="pwd">Discount Type:</label>
			<select name="type" id="choice"  class="form-control">
				<!-- <option value="">Select</option> -->
		   	<option value="1"  <?php if($data[0]->type=='1') {echo "selected";} ?> >Percentage</option>
			 
			<option value="2" <?php if($data[0]->type=='2') {echo "selected";} ?> > Rs.</option>
			</select>
		</div>
		<div class="form-group">
			<label for="pwd">Discount:</label>
			<input type="text" class="form-control" id="discount" value="{{ $data[0]->discount }}" placeholder="Discount" name="discount" onkeypress="return isNumber(event)">
			<span  style="color: red;" id="discount_error_message"></span><br><br>
		</div>
		<div class="form-group">
			<label for="pwd">Total:</label>
			<input type="text" class="form-control" id="total" value="{{ $data[0]->total }}" placeholder="Total" name="total" readonly="readonly" />
			<span  style="color: red;" id="total_error_message"></span><br><br>
		</div>
	
		<button type="submit"  name="save" class="btn btn-primary" id="butsave" >Update Product</button>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</form>
</div>
<script>
$(document).ready(function() {
	$('#fupForm').on('submit', function(event) {
		event.preventDefault();
		$("#butupdate").attr("disabled", "disabled");
        var id = $('#id').val();
       //var id= $(this).data('id');
        var url = "{{URL('edit')}}";
        
        var updateproduct = url +"/"+ id;
     
		var name = $('#name').val();
		var price = $('#price').val();
		var desc = $('#desc').val();
		var qty = $('#qty').val();
		var disc = $('#discount').val();
		var total = $('#total').val();
		if(id!="" && name!="" && price!="" && qty!="" && desc!="" && disc!="" && total!=""){
            
			$.ajax({
                
				url:updateproduct,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				//url: "/store",
				type: "POST",
				 data:new FormData(this),
				 dataType:'JSON',
				contentType:false,
				processData:false,
				cache: false,
				//	_token: '{!! csrf_token() !!}',
				   //_token: "{{ csrf_token() }}",
				//	name: name,
				//	price: price,
				//	desc: desc,
				//	qty: qty,
				//	discount: disc,
				//	total: total			
		
				
				
				success: function(dataResult){
					// alert(dataResult);

				
				//	var dataResult = JSON.parse(dataResult);
					if(dataResult=='1'){
						$("#butupdate").removeAttr("disabled");
						// $('#fupForm').find('input:text').val('');
						$("#success").show();
            $('#success').html('Data update successfully !');
                          //console.log(dataesult); 	
						  window.location = "{{URL('index')}}";					
					}
					else if(dataResult=='0'){
				   alert("Error occured Hello !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}	
$("#qty").bind('keyup mouseup', function () {
    var price = $('#price').val();
    var qty = $('#qty').val();
    var total = parseFloat(price) * parseFloat(qty);
    $('#total').val(total);
});
	
$("#price").bind('keypress mouseup', function(){
	var price = $('#price').val();
    var qty = $('#qty').val();
    var total = parseFloat(price) * parseFloat(qty);
    $('#total').val(total);
});
$("#discount").change(function(){
	var choice = $('#choice').val();
	    var price = $('#price').val();
		//var disc = $('#discount').val()// / 100;
		var qty = $('#qty').val();
	if(choice=="1")
	{
		var disc = $('#discount').val() / 100;
    	var total = parseFloat(price) * parseFloat(qty);
		var d_total = total - (total * disc);
		$("#total").val(d_total); 
	}
	//if(choice=="2")
	else
	{
		// var price = $('#price').val();
		var disc = $('#discount').val();
		// var qty = $('#qty').val();
    	var total = parseFloat(price) * parseFloat(qty);
		var d_total = total - disc;
		$("#total").val(d_total);
	}
});
//------------------------validation---------------------------
$(function() {
$("#productname_error_message").hide();
$("#productimg_error_message").hide();
$("#price_error_message").hide();
$("#desc_error_message").hide();
$("#qty_error_message").hide();
$("#discount_error_message").hide();
$("#total_error_message").hide();
var error_productname = false;
var error_productimg = false;
var error_price = false;
var error_desc = false;
var error_qty = false;
var error_discount = false;
var error_total = false;
$("#name").focusout(function() {
	check_name();
	
});

$("#productimg").change(function() {
	alert('clcickj')
				
	check_productimg();
	
	
});
$("#price").focusout(function() {
	check_price();
	
});
$("#desc").focusout(function() {
	check_desc();
	
});
$("#qty").focusout(function() {
	check_qty();
	
});
$("#discount").focusout(function() {
check_discount();
});
// $("input").change(function() {
//   console.log("Input text changed!");
// });
//  $("#total").change(function() {
// 	alert('Please fill all the fieldk !');
// 	 check_total();
// });
function check_name() {
	var name_length = $("#name").val().length;
	
	if(name_length < 3 || name_length > 20) {
		$("#productname_error_message").html("Should be between 3-20 characters");
		$("#productname_error_message").show();
		error_name = true;
	} else {
		$("#productname_error_message").hide();
	}
}
function check_productimg() {
	     
	var img = $('#productimg').val();
	var FileExtension = img.replace(/^.*\./, '');
	if(img!=""){    
	if($.inArray(FileExtension, ['gif','png','jpg','jpeg','bmp','jfif']) == -1) {
  
	
	   $("#productimg_error_message").html("Enter valid image Only gif, png, jpg, jpeg , bmp , jfif Accepted ");
	   $("#productimg_error_message").show();
	   
	   error_productimg = true;
   } 
   else {
	   $("#productimg_error_message").hide();
   }
}
else {
	   $("#productimg_error_message").hide();
   }
}
function check_price() {
   
	var price = $('#price').val();
     //var price =$("price").empty();
	
	if(price=="") {
		$("#price_error_message").html("Enter Price");
		$("#price_error_message").show();
		error_price = true;
	} else {
		$("#price_error_message").hide();
	}
}
function check_desc() {
	var desc_length = $("#desc").val().length;
	
	if(desc_length < 8) {
		$("#desc_error_message").html("At least 8 characters");
		$("#desc_error_message").show();
		error_desc= true;
	} else {
		$("#desc_error_message").hide();
	}
}
function check_qty() {
	var qty = $('#qty').val();
//var qty_length = $("#qty").val().length;
if(qty=="0" || qty=="" ) {
	$("#qty_error_message").html("At least 1 qty");
	$("#qty_error_message").show();
	error_qty= true;
} else {
	$("#qty_error_message").hide();
}
}
function check_discount() {
var discount_length = $("#discount").val().length;
if(discount_length < 1) {
	$("#discount_error_message").html("At least 0 number");
	$("#discount_error_message").show();
	error_discount= true;
} else {
	$("#discount_error_message").hide();
}
}
function check_total() {
	var total = $('#total').val();
//var qty_length = $("#qty").val().length;
if(total=="" || total > 0) {
	$("#total_error_message").html("At leas");
	$("#total_error_message").show();
	error_qty= true;
} else {
	$("#total_error_message").hide();
}
}
$("#butsave").click(function(){
 // alert(" clicked.");
  
 //});
//$("#fupForm").submit(function() {
										
	error_name = false;
	error_productimg = false;
	error_price = false;
	error_desc = false;
	error_qty = false;
	error_discount = false;
										
	check_name();
	check_productimg();
	check_price();
	check_desc();	
	check_qty();
	check_discount();
	
	if(error_name == false && error_productimg == false && error_price == false && error_desc== false  && error_qty == false   && error_discount == false) {
		return true;
	} else {
		return false;	
	}
});
});
//--------------------End----validation---------------------------


</script>
</body>
</html>
