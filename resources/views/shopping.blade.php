<!doctype html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title>Shopping Page</title>
  
</head>

<body>
       <h1>Shopping Page</h1>
       <h2>
     <a href = "{{route('cart.index')}}">
     <i class="fas fa-cart-plus"></i>
     Cart
    
     {{ Cart::getContent()->count()}}
     
     </a>
     </h2>

       <table border = "2"></h1></a>
<tr>
<td>Id</td>
<td>name</td>
<td>description</td>
<td>price</td>
<td>action</td>
</tr>
@foreach($producuts as $producut)
<tr>
<td>{{ $producut->id }}</td>
<td>{{ $producut->name }}</td>
<td>{{ $producut->description }}</td>
<td>{{ $producut->price }}</td>

<td><a href = "{{route('cart.add',$producut->id)}}">Add to Cart</a></td>

</tr>
@endforeach
</table>
   
</body>
</html>
