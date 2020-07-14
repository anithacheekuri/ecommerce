<!doctype html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title>this is cart </title>
   
    
</head>

<body>
     <h4>
     <a href = "{{route('cart.index')}}">
     <i class="fas fa-cart-plus"></i>
     Cart
     
     {{ Cart::getContent()->count()}}
     
     </a>
     </h4>
       <table border = "2"></h1></a>
<tr>

<td>name</td>

<td>price</td>
<td>Quantity</td>
<td>action</td>
</tr>
@foreach($cartItems as $Items)
<tr>

<td>{{ $Items->name }}</td>

<td>{{ $Items->price }}

{{Cart::get($Items->id)->getPriceSum()}}
</td>


<td>
<form action="{{route('cart.update',$Items->id)}}">
<input name="quantity" type="number" value ="{{ $Items->quantity }}">
  <input type ="submit" value ="save">
</form >
  
</td>

<td><a href = "{{route('cart.destroy',$Items->id)}}">Delete</a></td>

</tr>
@endforeach
</table>
<h3>Tota Price:$ {{ Cart::getSubTotal()}}</h3>

<h3><a href = "{{route('cart.checkout')}}">Proceed to Checkout</a></h3>
<script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
<script>paypal.Buttons().render('body');</script>
</body>
</html>
