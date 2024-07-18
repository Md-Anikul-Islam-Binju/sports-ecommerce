@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}

    <style>
        #dropzoneWrapperAdd, #dropzoneWrapperEdit {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .image-preview {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .image-preview img.img-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }

        .ck.ck-content {
            height: 250px;
        }

        /*------------------------------------
        Tagsinput
        ------------------------------------*/
        .u-tagsinput .bootstrap-tagsinput {
            width: 100%;
            border-color: #e7eaf3;
            border-radius: 0.3125rem;
            box-shadow: none;
            padding: 0.25rem;
            padding-bottom: 0;
        }
        .u-tagsinput .bootstrap-tagsinput::before {
            content: "|";
            display: inline-block;
            width: 1px;
            line-height: 1;
            font-size: 0.625rem;
            opacity: 0;
            padding: 0.75rem 0;
        }
        .u-tagsinput .bootstrap-tagsinput .tag {
            position: relative;
            display: inline-block;
            font-size: 0.875rem;
            color: #ffffff;
            background-color: #4fc6c9;
            border-radius: 0.3125rem;
            padding: 0.25rem 1.875rem 0.25rem 0.75rem;
            margin-bottom: 0.25rem;
            margin-right: 0;
        }
        .u-tagsinput .bootstrap-tagsinput .tag [data-role="remove"] {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            color: #fff;
            font-size: 1.25rem;
            outline: none;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .u-tagsinput .bootstrap-tagsinput .tag [data-role="remove"]::after {
            content: "\00d7";
        }
        .u-tagsinput .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            color: #fff;
            box-shadow: none;
        }



        .image-preview {
            margin-bottom: 10px;
        }

        .img-wrapper {
            position: relative;
            display: inline-block;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
        }

        .remove-preview {
            position: absolute;
            top: 0;
            right: 0;
            margin: 5px;
            padding: 0;
            line-height: 1;
        }
        .dropzoneWrapperEdit {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Wings</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                        <li class="breadcrumb-item active">Product!</li>
                    </ol>
                </div>
                <h4 class="page-title">Product!</h4>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Discount Amount</th>
                        <th>Stock</th>
                        <th>Available Stock</th>
                        <th>Stock Sell</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$productData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @php
                                    $images = json_decode($productData->image, true);
                                    $firstImage = $images ? $images[0] : 'default.png';
                                @endphp
                                <img src="{{ asset('images/product/' . $firstImage) }}" alt="Product Image" style="max-width: 50px;">
                            </td>
                            <td>{{$productData->name}}</td>
                            <td>{{$productData->amount? $productData->amount :'N/A'}}</td>
                            <td>{{$productData->discount_amount? $productData->discount_amount :'N/A'}}</td>

                            <td>{{$productData->stock}}</td>
                            <td>{{$productData->available_stock? $productData->available_stock :'N/A'}}</td>
                            <td>{{$productData->stock_sell? $productData->stock_sell :'N/A'}}</td>

                            <td>{{$productData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$productData->id}}">Edit</button>
                                    <a href="{{route('admin.product.destroy',$productData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$productData->id}}">Delete</a>
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$productData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$productData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$productData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.product.update',$productData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                   <div class="col-6">
                                                      <div class="mb-3">
                                                          <label for="category-select-{{$productData->id}}" class="form-label">Category</label>
                                                          <select name="category_id" id="category-select-{{$productData->id}}" class="form-select edit-category-select" data-product-id="{{ $productData->id }}">
                                                              @foreach($categories as $categoryData)
                                                              <option value="{{ $categoryData->id }}" {{ $productData->category_id == $categoryData->id ? 'selected' : '' }}>
                                                                  {{ $categoryData->name }}
                                                              </option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-6">
                                                      <div class="mb-3">
                                                          <label for="sub-category-select-{{$productData->id}}" class="form-label">Sub Category</label>
                                                          <select name="sub_category_id" id="sub-category-select-{{$productData->id}}" class="form-select">
                                                              <option value="">Select Sub Category</option>
                                                              <!-- Sub categories will be dynamically loaded here -->
                                                              @foreach($productData->subCategories as $subCategory)
                                                              <option value="{{ $subCategory->id }}" {{ $productData->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                                                  {{ $subCategory->name }}
                                                              </option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-12">
                                                      <div class="mb-3">
                                                          <label for="name" class="form-label">Name</label>
                                                          <input type="text" id="name" name="name" value="{{ $productData->name }}"
                                                                 class="form-control" placeholder="Enter Name" required>
                                                      </div>
                                                  </div>
                                              </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Amount</label>
                                                            <input type="text" name="amount" id="amount" class="form-control" value="{{$productData->amount}}"
                                                                   placeholder="Enter Amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Discount Amount</label>
                                                            <input type="text" id="discount_amount" name="discount_amount" value="{{$productData->discount_amount}}"
                                                                   class="form-control" placeholder="Enter Discount Amount">
                                                        </div>
                                                    </div>
                                                </div>

                                                  <div class="row">
                                                      <div class="col-12">
                                                          <div class="mb-3 u-tagsinput">
                                                              <label for="example-fileinput" class="form-label">Product Tags</label>
                                                              <input type="text" name="tags" class="form-control" value="{{ is_array(json_decode($productData->tags, true)) ? implode(',', json_decode($productData->tags, true)) : '' }}" data-role="tagsinput">
                                                          </div>
                                                      </div>
                                                  </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-textarea" class="form-label">Choose Size</label>
                                                            <select name="size_id[]" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Select Size ...">
                                                                @foreach($sizes as $sizeData)
                                                                    <option value="{{ $sizeData->id }}" {{ in_array($sizeData->size, $productData->sizes ?? []) ? 'selected' : '' }}>
                                                                        {{ $sizeData->size }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>




                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Stock</label>
                                                            <input type="text" id="stock" name="stock" value="{{$productData->stock}}"
                                                                   class="form-control" placeholder="Enter Stock">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label>Images</label>
                                                            <div id="dropzoneWrapperEdit{{$productData->id}}"  class="dropzoneWrapperEdit">
                                                                <i class="h1 text-muted ri-upload-cloud-2-line"></i><br>
                                                                <span>Drag and drop Product images</span>
                                                                <input type="file" name="image[]" id="image-input-edit{{$productData->id}}" multiple accept="image/*" style="display: none;">
                                                            </div>
                                                            <div id="image-preview-container-edit{{$productData->id}}">
                                                                @foreach (json_decode($productData->image, true) as $image)
                                                                    <div class="image-preview">
                                                                        <img src="{{ asset('images/product/' . $image) }}" alt="Product Image" class="img-preview">
                                                                        <div class="remove-preview" data-filename="{{ $image }}"><i class="ri-close-line"></i></div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="deleted_images" id="deleted-images-edit{{$productData->id}}" value="[]">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label> Details </label>
                                                            <textarea class="form-control editor"  name="details" rows="10" placeholder="Enter the Description">{!!$productData->details!!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">is Related</label>
                                                            <select name="is_related" class="form-select">
                                                                <option value="1" {{ $productData->is_related === 1 ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $productData->is_related === 0 ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">is New Arrival</label>
                                                            <select name="is_new_arrival" class="form-select">
                                                                <option value="1" {{ $productData->is_new_arrival === 1 ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $productData->is_new_arrival === 0 ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">is Popular</label>
                                                            <select name="is_popular" class="form-select">
                                                                <option value="1" {{ $productData->is_popular === 1 ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $productData->is_popular === 0 ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">is Customized</label>
                                                            <select name="is_customized" class="form-select">
                                                                <option value="1" {{ $productData->is_customized === 1 ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $productData->is_customized === 0 ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $productData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $productData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
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
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$productData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$productData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$productData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('admin.product.destroy',$productData->id)}}" class="btn btn-danger">Delete</a>
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="category-select" class="form-label">Category</label>
                                   <select name="category_id" id="category-select" class="form-select">
                                       <option selected>Select Category</option>
                                       @foreach($categories as $categoryData)
                                           <option value="{{ $categoryData->id }}">{{ $categoryData->name }}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="sub-category-select" class="form-label">Sub Category</label>
                                   <select name="sub_category_id" id="sub-category-select" class="form-select">
                                       <option value="">Select Sub Category</option>
                                       <!-- Sub categories will be dynamically loaded here -->
                                   </select>
                               </div>
                           </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                           placeholder="Enter Amount" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Discount Amount</label>
                                    <input type="text" id="discount_amount" name="discount_amount"
                                           class="form-control" placeholder="Enter Discount Amount">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3 u-tagsinput">
                                    <label for="example-fileinput" class="form-label">Product Tags</label>
                                    <input type="text" name="tags" class="form-control" value="" data-role="tagsinput">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Choose Project Section</label>
                                    <select name="size_id[]" class="select2 form-control select2-multiple" data-toggle="select2"
                                            multiple="multiple"  required>
                                        @foreach($sizes as $sizeData)
                                            <option value="{{$sizeData->id}}">{{$sizeData->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Stock</label>
                                    <input type="text" id="stock" name="stock"
                                           class="form-control" placeholder="Enter Stock">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Images</label>
                                    <div id="dropzoneWrapperAdd">
                                        <i class="h1 text-muted ri-upload-cloud-2-line"></i><br>
                                        <span>Drag and drop Product images</span>
                                        <input type="file" name="image[]" id="image-input-add" multiple accept="image/*" style="display: none;">
                                    </div>
                                    <div id="image-preview-container-add"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label> Details </label>
                                    <textarea class="form-control editor" name="details" style="height: 500px;" placeholder="Enter the Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">is Related</label>
                                    <select name="is_related" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">is New Arrival</label>
                                    <select name="is_new_arrival" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">is Popular</label>
                                    <select name="is_popular" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">is Customized</label>
                                    <select name="is_customized" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
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

{{--<script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            initializeImageUpload('dropzoneWrapperAdd', 'image-input-add', 'image-preview-container-add');--}}
{{--            initializeImageUpload('dropzoneWrapperEdit', 'image-input-edit', 'image-preview-container-edit');--}}
{{--        });--}}

{{--        function initializeImageUpload(wrapperId, inputId, previewContainerId) {--}}
{{--            const dropzoneWrapper = document.getElementById(wrapperId);--}}
{{--            const imageInput = document.getElementById(inputId);--}}
{{--            const previewContainer = document.getElementById(previewContainerId);--}}

{{--            dropzoneWrapper.addEventListener('click', () => imageInput.click());--}}
{{--            dropzoneWrapper.addEventListener('dragover', handleDragOver);--}}
{{--            dropzoneWrapper.addEventListener('dragleave', handleDragLeave);--}}
{{--            dropzoneWrapper.addEventListener('drop', (event) => handleDrop(event, imageInput));--}}
{{--            imageInput.addEventListener('change', handleImageUpload);--}}

{{--            function handleDragOver(event) {--}}
{{--                event.preventDefault();--}}
{{--                dropzoneWrapper.style.border = '2px dashed #999';--}}
{{--            }--}}

{{--            function handleDragLeave() {--}}
{{--                dropzoneWrapper.style.border = '2px dashed #ddd';--}}
{{--            }--}}

{{--            function handleDrop(event, input) {--}}
{{--                event.preventDefault();--}}
{{--                dropzoneWrapper.style.border = '2px dashed #ddd';--}}
{{--                handleImageUpload({target: input});--}}
{{--            }--}}

{{--            function handleImageUpload(event) {--}}
{{--                const files = event.target.files || event.dataTransfer.files;--}}

{{--                for (const file of files) {--}}
{{--                    if (file.type.startsWith('image/')) {--}}
{{--                        const reader = new FileReader();--}}

{{--                        reader.onload = function(e) {--}}
{{--                            const imageUrl = e.target.result;--}}
{{--                            createImagePreview(imageUrl, file);--}}
{{--                        };--}}

{{--                        reader.readAsDataURL(file);--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}

{{--            function createImagePreview(imageUrl, file) {--}}
{{--                const imagePreview = document.createElement('div');--}}
{{--                imagePreview.classList.add('image-preview');--}}

{{--                const imgElement = document.createElement('img');--}}
{{--                imgElement.src = imageUrl;--}}
{{--                imgElement.alt = file.name;--}}
{{--                imgElement.classList.add('img-preview');--}}

{{--                const removeButton = document.createElement('div');--}}
{{--                removeButton.classList.add('remove-preview');--}}
{{--                removeButton.innerHTML = '<i class="ri-close-line"></i>';--}}

{{--                removeButton.addEventListener('click', function() {--}}
{{--                    imagePreview.remove();--}}
{{--                });--}}

{{--                imagePreview.appendChild(imgElement);--}}
{{--                imagePreview.appendChild(removeButton);--}}
{{--                previewContainer.appendChild(imagePreview);--}}
{{--            }--}}
{{--        }--}}

{{--</script>--}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($products as $productData)
            initializeImageUpload('dropzoneWrapperEdit{{$productData->id}}', 'image-input-edit{{$productData->id}}', 'image-preview-container-edit{{$productData->id}}', 'deleted-images-edit{{$productData->id}}');
        @endforeach

        initializeImageUpload('dropzoneWrapperAdd', 'image-input-add', 'image-preview-container-add');
    });
    function initializeImageUpload(wrapperId, inputId, previewContainerId, deletedImagesInputId = null) {
        const dropzoneWrapper = document.getElementById(wrapperId);
        const imageInput = document.getElementById(inputId);
        const previewContainer = document.getElementById(previewContainerId);
        const deletedImagesInput = deletedImagesInputId ? document.getElementById(deletedImagesInputId) : null;
        dropzoneWrapper.addEventListener('click', () => imageInput.click());
        dropzoneWrapper.addEventListener('dragover', handleDragOver);
        dropzoneWrapper.addEventListener('dragleave', handleDragLeave);
        dropzoneWrapper.addEventListener('drop', (event) => handleDrop(event, imageInput));
        imageInput.addEventListener('change', handleImageUpload);

        previewContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-preview') || event.target.parentElement.classList.contains('remove-preview')) {
                const removeButton = event.target.closest('.remove-preview');
                const imagePreview = removeButton.closest('.image-preview');
                const filename = removeButton.getAttribute('data-filename');
                if (deletedImagesInput) {
                    const deletedImages = JSON.parse(deletedImagesInput.value);
                    deletedImages.push(filename);
                    deletedImagesInput.value = JSON.stringify(deletedImages);
                }
                imagePreview.remove();
            }
        });

        function handleDragOver(event) {
            event.preventDefault();
            dropzoneWrapper.style.border = '2px dashed #999';
        }

        function handleDragLeave() {
            dropzoneWrapper.style.border = '2px dashed #ddd';
        }

        function handleDrop(event, input) {
            event.preventDefault();
            dropzoneWrapper.style.border = '2px dashed #ddd';
            handleImageUpload({target: input});
        }

        function handleImageUpload(event) {
            const files = event.target.files || event.dataTransfer.files;

            for (const file of files) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imageUrl = e.target.result;
                        createImagePreview(imageUrl, file);
                    };

                    reader.readAsDataURL(file);
                }
            }
        }
        function createImagePreview(imageUrl, file) {
            const imagePreview = document.createElement('div');
            imagePreview.classList.add('image-preview');

            const imgElement = document.createElement('img');
            imgElement.src = imageUrl;
            imgElement.alt = file.name;
            imgElement.classList.add('img-preview');

            const removeButton = document.createElement('div');
            removeButton.classList.add('remove-preview');
            removeButton.innerHTML = '<i class="ri-close-line"></i>';

            removeButton.addEventListener('click', function() {
                imagePreview.remove();
            });

            imagePreview.appendChild(imgElement);
            imagePreview.appendChild(removeButton);
            previewContainer.appendChild(imagePreview);
        }
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadSubCategories(categoryId, subCategorySelectId) {
            if (categoryId) {
                $.ajax({
                    url: '/admin/categories/' + categoryId + '/sub-categories',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $(subCategorySelectId).empty();
                        $(subCategorySelectId).append('<option value="">Select Sub Category</option>');
                        $.each(data, function(key, value) {
                            $(subCategorySelectId).append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                $(subCategorySelectId).empty();
                $(subCategorySelectId).append('<option value="">Select Sub Category</option>');
            }
        }

        // Add Modal Category Change
        $('#category-select').on('change', function() {
            var categoryId = $(this).val();
            loadSubCategories(categoryId, '#sub-category-select');
        });

        // Edit Modal Category Change
        $('.edit-category-select').on('change', function() {
            var productId = $(this).data('product-id');
            var categoryId = $(this).val();
            loadSubCategories(categoryId, '#sub-category-select-' + productId);
        });

        // Load sub-categories when the edit modal is shown
        $('.edit-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var productId = button.data('product-id');
            var categorySelect = $('#category-select-' + productId);
            var categoryId = categorySelect.val();
            loadSubCategories(categoryId, '#sub-category-select-' + productId);
        });
    });
</script>

@endsection
