@extends('user.app')
@section('content')
    <!-- My Account -->
    <section class="wishlist_area p_tb_15 my_account_area">
        <div class="container">
            <div class="wishlist_wrap">
                <div class="ac-header">
                    <div class="left">

                        @php
                            $user = Auth::user();
                        @endphp
                        <span class="avatar">
                        @if($user->profile!=null)
                            <img src="{{asset('images/profile/'.$user->profile)}}" width="80" height="80" alt="AN"/>

                        @else
                            <img src="{{URL::to('images/default/pro.jpg')}}"
                                width="80"
                                height="80"
                                alt="AN"/>
                        @endif

                        </span>
                        <div class="name">
                            <p>Hello,</p>
                            <p class="user">{{$user->name}}</p>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a
                            href="#"
                            class="nav-link active"
                            id="order-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#order-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="order-tab-pane"
                            aria-selected="true"
                            >Orders</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link"
                            id="account-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#account-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="account-tab-pane"
                            aria-selected="true"
                            >Edit Account</a
                        >
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div
                        class="tab-pane fade show active"
                        id="order-tab-pane"
                        role="tabpanel"
                        aria-labelledby="order-tab"
                        tabindex="0"
                    >

                        @foreach($orders as $order)
                        <div class="cards">
                            <div class="card">
                                <div class="c-head">
                                    <div class="left">
                                        <span class="o-id"
                                            ><span
                                                >Order# {{ $order->order_tracking_id	}}</span
                                            ></span
                                        >
                                        <span class="o-date"
                                            >Date Added: {{  Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</span
                                        >
                                    </div>
                                    <div class="right">
                                        <span class="status delivered">
                                            <i class="bi bi-check"></i>
                                              <span class="status">
                                                @if($order->status == 'pending')
                                                   Pending
                                                @elseif($order->status == 'processing')
                                                    Processing
                                                @elseif($order->status == 'completed')
                                                    Delivered
                                                @elseif($order->status == 'declin')
                                                    Declined
                                                @endif
                                              </span>
                                            </span>
                                            <br>
                                         <br>
                                         @if($order->payment_method == 'online')
                                         <a id="button-confirm" href="{{route('payment.page',$order->id)}}" class="btn_style" type="submit">
                                             Payment
                                         </a>
                                         @endif
                                         <a id="button-confirm" href="{{route('user.invoice',$order->id)}}" class="btn_style" type="submit">
                                            Invoice
                                         </a>
                                    </div>

                                </div>
                                 @foreach($order->orderItem as $orderData)
                                 <div class="c-body">
                                    <div class="img-n-title">
                                        @php
                                            $images = json_decode($orderData->product->image, true);
                                            $firstImage = $images ? $images[0] : 'default.png';
                                        @endphp

                                        <div class="img-wrap">
                                            <a
                                                href="{{route('frontend.product.details', $orderData->product_id)}}"
                                                ><img
                                                    src="{{ asset('images/product/' . $firstImage) }}"
                                                    alt=""
                                                    style="height: 40px; width: 40px;"
                                            />
                                            </a>
                                        </div>
                                        <div class="title">
                                            <a href="{{route('order.info.review', $orderData->id)}}">
                                                <h6 class="item-name">
                                                    <span>{{$orderData->product_name}}</span>
                                                </h6>
                                                <p>In Stock</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="amount">{{$orderData->price*$orderData->quantity}}৳</div>
                                </div>
                                 @endforeach
                            </div>
                        </div>
                       @endforeach

                    </div>
                    <div
                        class="tab-pane fade"
                        id="account-tab-pane"
                        role="tabpanel"
                        aria-labelledby="account-tab"
                        tabindex="0"
                    >
                        <div class="page-section">
                            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="address">
                                    <div class="multiple-form-group">
                                        <div class="form-group">
                                            <label
                                                class="control-label"
                                                for="input-firstname"
                                                >First Name</label
                                            >
                                            <input
                                                class="form-control"
                                                name="name"
                                                type="text"
                                                id="input-firstname"
                                                value="{{$user->name}}"
                                                placeholder="First Name*"
                                            />
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="control-label"
                                                for="input-lastname"
                                                >Email</label
                                            >
                                            <input
                                                type="text"
                                                id="input-lastname"
                                                name="email"
                                                value="{{$user->email}}"
                                                class="form-control"
                                                placeholder="Last Email*"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            class="control-label"
                                            for="input-address"
                                            >Address</label
                                        >
                                        <input
                                            type="text"
                                            id="input-address"
                                            name="address"
                                            value="{{$user->address}}"
                                            class="form-control"
                                            placeholder="Address*"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label
                                            class="control-label"
                                            for="input-telephone"
                                            >Mobile</label
                                        >
                                        <input
                                            type="text"
                                            id="input-telephone"
                                            name="phone"
                                            value="{{$user->phone}}"
                                            class="form-control"
                                            placeholder="Telephone*"
                                        />
                                    </div>

                                    <div class="form-group">
                                        <label
                                            class="control-label"
                                            for="input-telephone"
                                            >Profile</label
                                        >
                                        <input
                                            type="file"
                                            id="input-telephone"
                                            name="profile"
                                            class="form-control"
                                            placeholder="Telephone*"
                                        />
                                    </div>

                                    <div
                                        class="form-group"
                                        for="input-old-password"
                                    >
                                        <label class="control-label"
                                            >Old Password</label
                                        >
                                        <input
                                            type="password"
                                            id="input-old-password"
                                            name="old-password"
                                            value=""
                                            class="form-control"
                                            placeholder="Old Password*"
                                        />
                                    </div>
                                    <div
                                        class="form-group"
                                        for="input-new-password"
                                    >
                                        <label class="control-label"
                                            >New Password</label
                                        >
                                        <input
                                            type="password"
                                            id="input-mew-password"
                                            name="new-password"
                                            value=""
                                            class="form-control"
                                            placeholder="New Password*"
                                        />
                                    </div>
                                    <div
                                        class="form-group"
                                        for="input-confirm-password"
                                    >
                                        <label class="control-label"
                                            >Confirm Password</label
                                        >
                                        <input
                                            type="password"
                                            id="input-confirm-password"
                                            name="confirm-password"
                                            value=""
                                            class="form-control"
                                            placeholder="Confirm Password*"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn_style"
                                    >
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection