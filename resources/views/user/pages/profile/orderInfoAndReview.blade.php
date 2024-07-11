@extends('user.app')
@section('content')
    <section class="order_details_page">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12">
                <ul class="order-view list-style-none theme_ws_box">
                    <li>
                        <label>Order number</label>
                        <strong>{{$orderItems->order->order_tracking_id}}</strong>
                    </li>
                    <li>
                    <label>Status</label>
                        @if($orderItems->order->status == 'pending')
                           <strong class="badge bg-danger">Pending</strong>
                        @elseif($orderItems->order->status == 'processing')
                           <strong class="badge bg-primary">Processing</strong>
                        @elseif($orderItems->order->status == 'completed')
                          <strong class="badge bg-success">Delivered</strong>
                        @elseif($orderItems->order->status == 'declin')
                          <strong class="badge bg-danger">Declined</strong>
                        @endif
                    </li>
                    <li>
                        <label>Date</label>
                        <strong>{{  Carbon\Carbon::parse($orderItems->order->created_at)->format('d M Y') }}</strong>
                    </li>
                    <li>
                        <label>Payment method</label>
                        <strong>
                            @if($orderItems->order->payment_method == 'cod')
                                <span class="badge bg-soft-success text-success">Cash On Delivery</span>
                            @else
                                <span class="badge bg-soft-info text-info">Online Payment</span>
                            @endif
                        </strong>
                    </li>
                </ul>
            </div>
            <!-- ! Order Product Info -->
            <div class="col-md-12 col-sm-12 details-section-wrap">
                <div class="page-section theme_ws_box">
                    <div class="section-head">
                        <h2>Product</h2>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table table-bordered bg-white checkout-data"
                        >
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Price</td>
                                    <td class="text-end">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="name">
                                        {{$orderItems->product->name}}
                                    </td>
                                    <td class="price">
                                        <span> {{$orderItems->price}}৳</span>
                                        <span> x </span>
                                        <span>{{$orderItems->quantity}}</span>
                                    </td>
                                    <td class="price text-end">
                                        {{$orderItems->price * $orderItems->quantity}} ৳
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Customer review -->
    <section class="review_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <form method="post" action="{{route('order.review.store')}}" class="theme_ws_box page-section">
                   @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="feedback_heading">
                                <h2>Give feedback</h2>
                                <p>
                                    Please share your experience...
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="star-rating__wrap mb-3">
                                <input type="hidden" name="product_id" value="{{$orderItems->product_id}}">
                                <input
                                    class="star-rating__input"
                                    id="other-rating-5"
                                    type="radio"
                                    name="ratting"
                                    value="5"
                                />
                                <label
                                    class="star-rating__ico bi bi-star"
                                    for="other-rating-5"
                                    title="5 out of 5 stars"
                                ></label>
                                <input
                                    class="star-rating__input"
                                    id="other-rating-4"
                                    type="radio"
                                    name="ratting"
                                    value="4"
                                />
                                <label
                                    class="star-rating__ico bi bi-star"
                                    for="other-rating-4"
                                    title="4 out of 5 stars"
                                ></label>
                                <input
                                    class="star-rating__input"
                                    id="other-rating-3"
                                    type="radio"
                                    name="ratting"
                                    value="3"
                                />
                                <label
                                    class="star-rating__ico bi bi-star"
                                    for="other-rating-3"
                                    title="3 out of 5 stars"
                                ></label>
                                <input
                                    class="star-rating__input"
                                    id="other-rating-2"
                                    type="radio"
                                    name="ratting"
                                    value="2"
                                />
                                <label
                                    class="star-rating__ico bi bi-star"
                                    for="other-rating-2"
                                    title="2 out of 5 stars"
                                ></label>
                                <input
                                    class="star-rating__input"
                                    id="other-rating-1"
                                    type="radio"
                                    name="ratting"
                                    value="1"
                                />
                                <label
                                    class="star-rating__ico bi bi-star"
                                    for="other-rating-1"
                                    title="1 out of 5 stars"
                                ></label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="user_feadback"
                                    >Write your feedback.</label
                                >
                                <textarea
                                    class="form-control"
                                    name="details"
                                    id="user_feadback"
                                    rows="4"
                                    placeholder="Write here....."
                                ></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn_style" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>
@endsection