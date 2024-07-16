@extends('user.app')

@section('content')
<section class="wishlist_area">
    <div class="container">
        <div class="row">
            <div class="ac-title">
                <h1>My Wish List</h1>
            </div>
            @if(count($wishlists) > 0)
            <div class="cards">
                @foreach($wishlists as $wishlist)
                <div class="card">
                    <div class="img-n-title">
                        <div class="img-wrap">
                           @php
                               $images = json_decode($wishlist->product->image, true);
                               $firstImage = !empty($images) ? $images[0] : 'default.png';
                               $imagePath = asset('images/product/' . $firstImage);
                           @endphp
                           <a href="#">
                               <img src="{{ $imagePath }}"
                                   alt="Product Image" title="Product Image" draggable="false" style="max-width: 50px;">
                           </a>
                        </div>
                        <div class="title">
                            <h6 class="item-name">
                                <a href="#">{{ $wishlist->product->name }}</a>
                            </h6>
                            <p>In Stock</p>
                        </div>
                    </div>
                    <div class="amount">26,000৳</div>
                    <div class="actions">
                        <a href="{{route('frontend.product.details',$wishlist->product_id )}}" class="btn_style" title="Buy Now">
                            Buy Now
                        </a>
                        <a href="{{route('wishlist.remove',$wishlist->id)}}" title="Remove" class="ac-ico">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p>No items found in your wishlist.</p>
            <div class="pull-right">
                <a href="{{route('frontend.all.product')}}" class="btn_style">Continue Shopping</a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
