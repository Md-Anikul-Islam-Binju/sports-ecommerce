@extends('user.app') @section('content')
<section class="website_dynamic_content_wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(!empty($aboutUs))
                <div class="website_dynamic_content">
                    {!!$aboutUs->details!!}
                </div>
                @else
                   No data found
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
