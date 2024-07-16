@extends('admin.app')
@section('admin_content')
    <style>
        .ck.ck-content {
            height: 250px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Wings</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Other Setting</a></li>
                        <li class="breadcrumb-item active">Other Setting!</li>
                    </ol>
                </div>
                <h4 class="page-title">Other Setting!</h4>
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
                        <th>Category</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($otherSetting as $key=>$otherSettingData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if($otherSettingData->category == 'privacy_policy')
                                    Privacy Policy
                                @elseif($otherSettingData->category == 'terms_condition')
                                    Terms & Condition
                                @elseif($otherSettingData->category == 'faq')
                                    FAQ
                                @elseif($otherSettingData->category == 'about')
                                    About
                                @elseif($otherSettingData->category == 'return_policy')
                                    Return Policy
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($otherSettingData->details), 50) }}</td>
                            <td style="width: 100px;">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$otherSettingData->id}}">Edit</button>
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$otherSettingData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$otherSettingData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$otherSettingData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('admin.other.setting.update',$otherSettingData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Category</label>
                                                            <select name="category" class="form-select">
                                                               <option value="privacy_policy" {{ $otherSettingData->category === 'privacy_policy' ? 'selected' : '' }}>Privacy Policy</option>
                                                               <option value="return_policy" {{ $otherSettingData->category === 'return_policy' ? 'selected' : '' }}>Return Policy</option>
                                                               <option value="terms_condition" {{ $otherSettingData->category === 'terms_condition' ? 'selected' : '' }}>Terms & Condition</option>
                                                               <option value="faq" {{ $otherSettingData->category === 'faq' ? 'selected' : '' }}>FAQ</option>
                                                               <option value="about" {{ $otherSettingData->category === 'about' ? 'selected' : '' }}>About</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label> Details </label>
                                                            <textarea class="form-control editor"  name="details" rows="10" placeholder="Enter the Description">{!!$otherSettingData->details!!}</textarea>
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
                    <form method="post" action="{{route('admin.other.setting.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Category</label>
                                       <select name="category" class="form-select">
                                          <option selected>Select Category</option>
                                          <option value="privacy_policy">Privacy Policy</option>
                                          <option value="return_policy">Return Policy</option>
                                          <option value="terms_condition">Terms & Condition</option>
                                          <option value="faq">FAQ</option>
                                          <option value="about">About</option>
                                       </select>
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
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
