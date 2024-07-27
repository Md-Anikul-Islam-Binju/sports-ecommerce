@extends('user.app')
@section('content')
    <section class="cart_area">
        <div class="container">
            <div class="row">
                <div class="content theme_ws_box p_15">
                    <h1 class="title">Shopping Cart</h1>
                    @php
                        $subTotal = 0; // Initialize subtotal variable
                    @endphp
                    @if(count($cart) > 0)
                    <form id="cartForm" action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" id="action" value="">
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <div class="table-responsive">
                            <table class="table table-bordered cart-table bg-white">
                                <thead>
                                    <tr>
                                        <td class="text-center table_data_none">Image</td>
                                        <td class="text-left">Product Name</td>
                                        <td class="table_data_none text-center">Size</td>
                                        <td class="text-left text-center">Quantity</td>
                                        <td class="text-end table_data_none">Unit Price</td>
                                        <td class="text-end">Total</td>
                                        <td class="text-end">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $key => $item)
                                    @php
                                        $subTotal += $item['price'] * $item['qty']; // Calculate subtotal

                                    @endphp
                                    <tr>
                                        <td class="text-center table_data_none">
                                            @php
                                                $images = json_decode($item['image'], true);
                                                $firstImage = $images ? $images[0] : 'default.png';
                                            @endphp
                                            <a href="#">
                                                <img src="{{ asset('images/product/' . $firstImage) }}"
                                                    alt="Product Image" title="Product Image" draggable="false" style="max-width: 50px;">
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a>{{ $item['product_name'] }}</a>
                                        </td>
                                        <td class="text-center">{{ $item['size_name'] }}</td>
                                        <td class="text-center">
                                            <div class="qty-container">
                                                <button type="button" class="btn btn-light btn-minus" data-product-id="{{ $key }}">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="number" name="qty[{{ $key }}]" value="{{ $item['qty'] }}" class="input-qty" readonly>
                                                <button type="button" class="btn btn-light btn-plus" data-product-id="{{ $key }}">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-end table_data_none">
                                            {{ $item['price'] }} ৳
                                        </td>
                                        <td class="text-end">
                                            {{ $item['price'] * $item['qty'] }} ৳
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('cart.item.remove', $key) }}" class="btn btn-danger btn-sm">
                                             <i class="bi bi-trash3-fill text-white"></i>
                                             </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered bg-white cart-total">
                                <tbody>
                                    <tr>
                                        <td class="text-right"><strong>Sub-Total:</strong></td>
                                        <td class="text-right amount">{{ $subTotal }}৳</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><strong>Total:</strong></td>
                                        <td class="text-right amount">{{ $subTotal }}৳</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="pull-right">
                            <a href="{{route('frontend.all.product')}}" class="btn_style">Continue Shopping</a>
                        </div>

                        @php
                            $user = Auth::user();
                        @endphp





                        @if($user)
                            <div class="pull-right">
                                <a href="{{ route('checkout.order') }}" class="btn_style">Checkout</a>
                            </div>
                        @else

                            <div class="pull-right">
                                <a href="{{route('checkout.as.gust.order')}}" class="btn_style" style="background-color: red">Checkout as Gust</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn_style">Checkout</button>
                            </div>
                        @endif


                        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('user.login.post') }}"> @csrf

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" required name="email" placeholder="Enter your email*" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" required name="password" placeholder="Enter your password*" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn_style w-100"> Login </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <p> Don't have an account? <a href="{{ route('user.register') }}" class="text-decoration-underline">Register</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>No items found in your cart.</p>
                    <div class="pull-right">
                        <a href="{{route('frontend.all.product')}}" class="btn_style">Continue Shopping</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const form = document.getElementById('cartForm');
		const actionInput = document.getElementById('action');
		const productIdInput = document.getElementById('product_id');

		form.querySelectorAll('.btn-minus').forEach(button => {
			button.addEventListener('click', function() {
				const productId = this.getAttribute('data-product-id');
				const input = form.querySelector(`input[name="qty[${productId}]"]`);
				if (input.value > 1) {
					input.value--;
					actionInput.value = 'minus';
					productIdInput.value = productId;
					form.submit();
				}
			});
		});

		form.querySelectorAll('.btn-plus').forEach(button => {
			button.addEventListener('click', function() {
				const productId = this.getAttribute('data-product-id');
				const input = form.querySelector(`input[name="qty[${productId}]"]`);
				input.value++;
				actionInput.value = 'plus';
				productIdInput.value = productId;
				form.submit();
			});
		});
	});
</script>
@endsection
