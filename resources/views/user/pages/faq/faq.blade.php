@extends('user.app')
@section('content')
	<section class="website_dynamic_content_wrap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-8">
					 @if(!empty($faq))
					<div class="faq_content">
						{!!$faq->details!!}
					</div>
					@else
                       No data found
                    @endif
				</div>
			</div>
		</div>
	</section>
@endsection
