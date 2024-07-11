@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Wings</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Review</a></li>
                        <li class="breadcrumb-item active">Review!</li>
                    </ol>
                </div>
                <h4 class="page-title">Review!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>User Name</th>
                        <th>Ratting</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($review as $key=>$reviewData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @php
                                    $images = json_decode($reviewData->product->image, true);
                                    $firstImage = $images ? $images[0] : 'default.png';
                                @endphp
                                <img src="{{ asset('images/product/' . $firstImage) }}" alt="Product Image" style="max-width: 50px;">
                            </td>
                            <td>{{$reviewData->product->name}}</td>
                            <td>{{$reviewData->user->name}}</td>
                            <td>{{$reviewData->ratting}}</td>
                            <td>{{$reviewData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex  gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$reviewData->id}}">Details</button>
                                </div>
                            </td>
                            <div class="modal fade" id="editNewModalId{{$reviewData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$reviewData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$reviewData->id}}">Message</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                        <form method="post" action="{{route('admin.review.update',$reviewData->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <textarea rows="10" type="text" disabled
                                                               class="form-control">{{$reviewData->details}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="example-select" class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="1" {{ $reviewData->status === 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $reviewData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                             <div class="d-flex justify-content-end">
                                                 <button class="btn btn-primary" type="submit">Update</button>
                                             </div>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
