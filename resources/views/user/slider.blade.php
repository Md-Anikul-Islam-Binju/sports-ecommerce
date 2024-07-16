<!-- Hero Slider -->
@php
$sliders = DB::table('sliders')->where('status',1)->latest()->get();
@endphp

<section class="hero_slider_wrapper">
    <div class="swiper heroSlider">

        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
            <div class="swiper-slide">

                <a href="#">
                    <img
                        draggable="false"
                        src="{{URL::to('images/slider/'.$slider->image )}}"
                        class="img-fluid"
                        alt=""
                    />
                </a>

            </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>
