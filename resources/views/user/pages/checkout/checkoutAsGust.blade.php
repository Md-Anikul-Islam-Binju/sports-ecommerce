@extends('user.app')
@section('content')
    <!-- ! Checkout -->
    <section class="checkout_area p_tb_15">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="title">Checkout As Gust</h1>
                    <form class="checkout-content" id="checkout-form" action="{{route('order.place.as.gust')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="page-section theme_ws_box">
                                    <div class="section-head">
                                        <h2><span>1</span>Shipping Information</h2>
                                    </div>
                                    <div class="address">
                                        <div class="form-group">
                                            <label class="control-label" for="input-firstname"> Name</label>
                                            <input class="form-control" name="name" type="text" id="input-firstname" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-telephone">Mobile</label>
                                            <input type="tel" id="input-telephone" name="phone"  class="form-control" required />
                                        </div>
                                        <div class="form-group" for="input-email">
                                            <label class="control-label">Email</label>
                                            <input type="email" id="input-email" name="email" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-address">Address</label>
                                            <textarea type="text" id="input-address" name="address"  class="form-control" /></textarea>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="row row-payment-delivery-order">
                                    <div class="col-md-6 col-sm-12 payment-methods">
                                        <div class="page-section theme_ws_box">
                                            <div class="section-head">
                                                <h2><span>2</span>Payment Method</h2>
                                            </div>
                                            <p>
                                                Select a payment method
                                            </p>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_method" value="cod" checked="checked" />
                                                Cash on Delivery
                                            </label>
                                            <br />
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_method" value="online" />
                                                Online Payment
                                            </label>
                                            <br />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 delivery-methods">
                                        <div class="page-section theme_ws_box">
                                            <div class="section-head">
                                                <h2><span>3</span>Delivery Charge</h2>
                                            </div>
                                            <p>
                                                Select a delivery charge
                                            </p>
                                            <label class="radio-inline">
                                                <input type="radio" name="delivery_charge" value="60" onclick="updateShippingFee()" checked />
                                                Inside Dhaka - 60৳
                                            </label>

                                            <br />

                                            <label class="radio-inline">
                                                <input type="radio" name="delivery_charge" value="120" onclick="updateShippingFee()" />
                                                Outside Dhaka - 120৳
                                            </label>
                                            <br />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 details-section-wrap">
                                        <div class="page-section theme_ws_box">
                                            <div class="section-head">
                                                <h2><span>4</span>Order Overview</h2>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered bg-white checkout-data">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-center table_data_none">
                                                            Image
                                                        </td>
                                                        <td>
                                                            Product Name
                                                        </td>
                                                        <td>
                                                            Price
                                                        </td>

                                                        <td class="text-end">
                                                            Total
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $subTotal = 0;
                                                        //$deliveryCharge=60;
                                                    @endphp
                                                    @foreach($cart as $key => $item)
                                                        @php
                                                            $subTotal += $item['price'] * $item['qty']; // Calculate subtotal
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center table_data_none">
                                                                @php $images = json_decode($item['image'], true); $firstImage = $images ? $images[0] : 'default.png'; @endphp
                                                                <a href="#">
                                                                    <img src="{{ asset('images/product/' . $firstImage) }}" alt="Product Image" title="Product Image" draggable="false" style="max-width: 50px;" />
                                                                </a>
                                                            </td>
                                                            <td class="name">
                                                                <a>{{ $item['product_name'] }}</a>
                                                                <div class="options"></div>
                                                            </td>
                                                            <td class="price">
                                                                <span>{{ $item['price'] }}৳</span>
                                                                <span>
                                                                x
                                                            </span>
                                                                <span>{{ $item['qty'] }}</span>
                                                            </td>
                                                            <td class="price text-end">
                                                                {{ $item['price'] * $item['qty'] }} ৳
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="total">
                                                        <td colspan="3" class="text-end">
                                                            <strong>Sub-Total:</strong>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="amount">{{$subTotal}}৳</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="total">
                                                        <td colspan="3" class="text-end">
                                                            <strong> Delivery Charge:</strong>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="amount" id="shippingFee">60</span>
                                                            <input type="hidden"  id="subTotal" value="{{ $subTotal }}">
                                                        </td>
                                                    </tr>
                                                    <tr class="total">
                                                        <td colspan="3" class="text-end">
                                                            <strong>Total:</strong>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="amount" id="totalAmount">{{$subTotal+60}}৳</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-final-action">
                            <div class="agree-text">
                                I have read and agree to the
                                <a href="#" target="_blank"><b>Terms and Conditions</b></a>,
                                <a href="#" target="_blank"><b>Privacy Policy</b></a>
                                and
                                <a href="#" target="_blank"><b>Refund and Return Policy</b></a>
                                <input type="checkbox" name="agree" value="1" checked="checked" />
                            </div>
                            <button id="button-confirm" class="btn_style" type="submit">
                                Confirm Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Function to update the shipping fee
        function updateShippingFee() {
            // Get the selected radio button value
            var shippingFee = parseFloat(document.querySelector('input[name="delivery_charge"]:checked').value);
            var subTotal = parseFloat(document.getElementById('subTotal').value);
            // Calculate the total amount
            var totalAmount = subTotal + shippingFee;
            // Update the shipping fee display with currency symbol
            document.getElementById('shippingFee').innerText = shippingFee + '৳';
            document.getElementById('totalAmount').innerText = totalAmount + '৳';
        }
        // Initialize the default shipping fee on page load
        window.onload = function() {
            updateShippingFee();
        };
    </script>
@endsection
