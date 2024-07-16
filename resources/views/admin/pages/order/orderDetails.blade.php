@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Wings</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                    <li class="breadcrumb-item active">Details!</li>
                </ol>
            </div>
            <h4 class="page-title">Details Order!</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="d-flex">
                        <a class="me-3" href="#">

                         @if($order->user->profile!=null)

                            <img class="avatar-md rounded-circle bx-s"
                                src="{{URL::to('images/profile/'.$order->user->profile)}}" alt="">
                        @else
                            <img class="avatar-md rounded-circle bx-s"
                                src="{{URL::to('images/default/pro.jpg')}}" alt="">
                        @endif
                        </a>
                        <div class="info">
                            <h5 class="fs-18 my-1">{{$order->user->name}}</h5>
                            <p class="text-muted fs-15">{{$order->user->email}}</p>
                        </div>
                    </div>

                </div>

                <hr>
                <ul class="social-list list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                     <p class="text-muted fs-15">Phone: +88{{$order->user->phone}}</p>
                     <p class="text-muted fs-15">Address: {{$order->user->address}}</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Order Information</h4>
                    <p class="text-muted mb-0">
                      Invoice No: {{$order->invoice_no}}
                    </p>
                    <p class="text-muted mb-0">
                      Order Date: {{  Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Order Tracking no</th>
                                    <th>Payment Method</th>
                                    <th>Delivery Charge</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$order->order_tracking_id}}</td>
                                    <td>
                                        @if($order->payment_method == 'cod')
                                            <span class="badge bg-soft-success text-success">Cash On Delivery</span>
                                        @else
                                            <span class="badge bg-soft-info text-info">Online Payment</span>
                                        @endif
                                     </td>
                                    <td>{{$order->delivery_charge}} Tk</td>
                                    <td>{{$order->total}} Tk</td>
                                     <td>
                                        @if($order->status == 'pending')
                                          <span style="color: blue">Pending</span>
                                        @elseif($order->status == 'processing')
                                          <span style="color: orange">Processing</span>
                                        @elseif($order->status == 'completed')
                                          <span style="color: green">Completed</span>
                                        @elseif($order->status == 'declined')
                                          <span style="color: red">Declined</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Order Summery</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Qty</th>
                                <th scope="col">Per Qty Price</th>
                                <th scope="col">Total  Price</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($order->orderItem as $index => $item)
                              @php
                                  $images = json_decode($item->product->image, true);
                                  $firstImage = $images ? $images[0] : 'default.png';
                              @endphp
                              <tr>
                                  <th scope="row">{{ $index + 1 }}</th>
                                  <td><img src="{{ asset('images/product/' . $firstImage) }}" alt="Product Image" style="width: 50px; height: 50px;"></td>
                                  <td>{{ $item->product->name }}</td>
                                  <td>{{ $item->quantity }}</td>
                                  <td>{{ $item->price }}</td>
                                  <td>{{ $item->price * $item->quantity }}</td>
                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($order->payment_method == 'online')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Payment Information</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>

                                <th scope="col">Amount</th>
                                <th scope="col">Transaction Id</th>
                                <th scope="col">Status</th>
                                 <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>

                              <tr>

                                  <td>{{ $order->payment->amount }}</td>
                                  <td>{{ $order->payment->transaction_id }}</td>
                                  <td>
                                   @if($order->payment->status == 'pending')
                                     <span style="color: blue">Pending</span>
                                    @elseif($order->payment->status == 'completed')
                                        <span style="color: green">Completed</span>
                                   @endif
                                  </td>
                                  <td> {{  Carbon\Carbon::parse($order->payment->created_at)->format('d M Y') }}</td>
                              </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Update Order Status</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.order.status.update',$order->id)}}">
                @csrf
                    <div class="row g-2">

                        <div class="mb-3 col-md-12">
                            <label for="inputState" class="form-label">State</label>
                            <select name="status" id="inputState" class="form-select">
                                @if($order->status == 'pending')
                                  <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                  <option value="processing">Processing</option>
                                @elseif($order->status == 'processing')
                                  <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                  <option value="completed">Completed</option>
                                  <option value="declined">Declined</option>
                                @elseif($order->status == 'completed')
                                  <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                @elseif($order->status == 'declined')
                                  <option value="declined" {{ $order->status === 'declined' ? 'selected' : '' }}>Declined</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3 col-md-12" id="declinedReason" style="display: none;">
                            <label for="declinedReasonInput" class="form-label">Reason for Decline</label>
                            <input type="text" name="remark" id="declinedReasonInput" value="{{$order->remark}}" class="form-control">
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary">Change Status</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputState = document.getElementById('inputState');
        const declinedReason = document.getElementById('declinedReason');

        inputState.addEventListener('change', function() {
            if (this.value === 'declined') {
                declinedReason.style.display = 'block';
            } else {
                declinedReason.style.display = 'none';
            }
        });

        // Trigger change event on page load to initialize visibility
        inputState.dispatchEvent(new Event('change'));
    });
</script>
@endsection
