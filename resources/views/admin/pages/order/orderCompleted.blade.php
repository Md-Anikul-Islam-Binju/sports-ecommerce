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
                        <li class="breadcrumb-item active">Completed!</li>
                    </ol>
                </div>
                <h4 class="page-title">Completed Order!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Invoice No</th>
                        <th>User Name</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$ordersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ordersData->invoice_no}}</td>
                            <td>{{$ordersData->user->name}}</td>
                            <td>{{$ordersData->total}}</td>
                            <td>
                                @if($ordersData->status == 'pending')
                                  <span style="color: blue">Pending</span>
                                @elseif($ordersData->status == 'processing')
                                  <span style="color: orange">Processing</span>
                                @elseif($ordersData->status == 'completed')
                                  <span style="color: green">Completed</span>
                                @elseif($ordersData->status == 'declined')
                                  <span style="color: red">Declined</span>
                                @endif
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex gap-1">
                                    <a href="{{route('admin.order.invoice',$ordersData->id)}}" class="btn btn-primary btn-sm">Invoice</a>
                                    <a href="{{route('admin.order.details',$ordersData->id)}}"class="btn btn-info btn-sm">Details</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
