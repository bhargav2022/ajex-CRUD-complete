
@foreach($product as $value)
<tr>
<td>{{ $value->id }}</td>
<td>{{ $value->name }}</td>
<td> <img src="productimg/{{ $value->productimg}}" height='50px'></img></td>
<td>{{ $value->price }}</td>
<td>{{ $value->desc }}</td>
<td>{{ $value->qty }}</td>
<td>
@if($value->type==1)
     <?php echo "Percentage"; ?> 
@endif
@if($value->type==2)
<?php echo "RS."; ?> 
@endif
</td>
<td>{{ $value->discount }}</td>
<td>{{ $value->total }}</td>
<td><a  href="update/{{ $value->id }}" class="fas fa-edit" data-id="{{ $value->id }}">Edit</a></td>
<td><a id="del" href="javascript:void(0)"  data-id="{{ $value->id }}" >Delete</a></td>
<!-- href="delete/{{ $value->id }}" -->
</tr>
@endforeach
<script
    src=//code.jquery.com/jquery-3.5.1.min.js
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin=anonymous>
//   
}

    </script>

