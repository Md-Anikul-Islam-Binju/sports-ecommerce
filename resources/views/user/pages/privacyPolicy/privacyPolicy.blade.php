@extends('user.app')
@section('content')
	<section class="website_dynamic_content_wrap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					@if(!empty($privacyPolicy))
					<div class="website_dynamic_content extra_heading_space">
						{!!$privacyPolicy->details!!}
					</div>
					@else
                       No data found
                    @endif
				</div>
			</div>
		</div>
	</section>
@endsection
