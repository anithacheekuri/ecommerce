<!doctype html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title>Shopping Page</title>
    <link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
<!--
@foreach($producuts as $producut)
<tr>
<td>{{ $producut->id }}</td>
<td>{{ $producut->name }}</td>
<td>{{ $producut->description }}</td>
<td>{{ $producut->price }}</td>

<td><a href = "{{route('cart.add',$producut->id)}}">Add to Cart</a></td>

</tr>
@endforeach-->
</table>
<br><br>
<div class="container">
		<form action="/search" method="POST" role="search">
			{{ csrf_field() }}
			<div class="input-group">
				<input type="text" class="form-control" name="q"
					placeholder="Search users"> <span class="input-group-btn">
					<button type="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>
		<div class="container">
			@if(isset($details))
			<p> The Search results for your query <b> {{ $query }} </b> are :</p>
			<h2>Sample User details</h2>
			<table class="table table-striped">
				<thead>
				<tr>
						<th>Name</th>
            <th> description</th>
						<th>price</th>
           
            <th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($details as $producut)
					<tr>
						<td>{{$producut->name}}</td>
						<td>{{$producut->description}}</td>
            <td>{{$producut->price}}</td>
            <td><a href = "{{route('cart.add',$producut->id)}}">Add to Cart</a></td>
					</tr>
					
					
					@endforeach
				</tbody>
			</table>
			@elseif(isset($message))
			<p>{{ $message }}</p>
			@endif
		</div>

   
</body>
</html>
