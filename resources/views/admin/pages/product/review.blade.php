@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <style>
        /* Customer review */
        .star-rating__wrap {
            display: flex;
            justify-content: start;
            gap: 40px;
            align-items: center;
            flex-direction: row-reverse;
            margin-bottom: 10px;
        }
        .star-rating__ico {
            float: left;
            padding-left: 2px;
            cursor: pointer;
            color: #72bf44;
            font-size: 35px;
        }
        .star-rating__ico:last-child {
            padding-left: 0;
        }
        .star-rating__input {
            display: none;
        }
        .star-rating__ico:hover:before,
        .star-rating__ico:hover ~ .star-rating__ico:before,
        .star-rating__input:checked ~ .star-rating__ico:before {
            content: "\F586";
        }
    </style>
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
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
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
                                                        <label for="name" class="form-label">Review</label>
                                                        <textarea rows="10" type="text" disabled
                                                               class="form-control">{{$reviewData->details}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Profile</label>
                                                        <input type="file" name="profile" id="example-fileinput" class="form-control">
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

    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.review.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Product</label>
                                    <select name="product_id" class="form-select">
                                        <option selected>Select Product For Review</option>
                                        @foreach($product as $productData)
                                            <option value="{{$productData->id}}">{{$productData->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Customer Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Customer Email</label>
                                    <input type="text" id="email" name="email"
                                           class="form-control" placeholder="Enter email">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Customer Phone</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control" placeholder="Enter Phone" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="profile" class="form-label">Customer Profile</label>
                                    <input type="file" id="profile" name="profile"
                                           class="form-control" placeholder="Enter Profile">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="details" class="form-label">Review</label>
                                    <textarea rows="5" type="text" name="details"
                                              class="form-control"></textarea>
                                </div>
                            </div>

                            <label for="example-select" class="form-label">Ratting</label>
                            <div class="star-rating__wrap mb-3">
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
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
