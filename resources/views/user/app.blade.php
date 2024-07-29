<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Wings Keep Flyings</title>
        <link
            rel="icon"
            href="{{ asset('frontend/images/favicon.ico') }}"
            type="image/x-icon"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/plugin/bootstrap/bootstrap.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/plugin/aos/aos.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/plugin/swiper/swiper-bundle.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{
                asset('frontend/plugin/bootstrap-icons/bootstrap-icons.css')
            }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('frontend/plugin/easyzoom/easyzoom.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    </head>
    <body>
        <!-- Header -->
        <header class="header_area sticky-top d-print-none">
            <div class="container">
                <div class="header_wrapper">
                    <div class="header_action d-lg-none hamburger_icon">
                        <ul>
                            <li>
                                <a
                                    data-bs-toggle="offcanvas"
                                    href="#offcanvasExample"
                                    role="button"
                                    aria-controls="offcanvasExample"
                                >
                                    <i class="bi bi-list"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="header_logo">
                        <a href="{{ url('/') }}">
                            <img
                                draggable="false"
                                src="{{URL::to('frontend/images/logo.png')}}"
                                alt="wings keep flyings"
                                class="img-fluid"
                            />
                        </a>
                    </div>
                    <div class="header_menu d-none d-lg-block">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                <a href="{{ route('frontend.all.product') }}"
                                    >Products</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('user.about.us') }}">About</a>
                            </li>
                            <li>
                                <a href="{{ route('user.contact.us') }}"
                                    >Contact</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="header_action">
                        @php $cart=0; $cart = Session::get('cart', []); @endphp
                        <ul>
							<li>
								<div class="search-container">
									<form action="{{ route('frontend.all.product') }}">
										<input class="search expandright" id="searchright" type="search" name="search" placeholder="Search">
										<label class="button searchbutton" for="searchright">
											<i class="bi bi-search mglass"></i>
										</label>
									</form>
								</div>
							</li>
                            @php
                               $wishlists = App\Models\Wishlist::where('user_id', Auth::id())->count();
                            @endphp
                            <li>
                                <a href="{{route('wishlist')}}">
                                    <i class="bi bi-heart"></i>
                                    <span>{{$wishlists}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart.show') }}">
                                    <i class="bi bi-cart"></i>
                                    <span>{{ count($cart) }}</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown profile_image">
                                @if(Auth::check())
                                <a
                                    href="#"
                                    class="d-block link-dark text-decoration-none dropdown-toggle"
                                    id="dropdownUser1"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    @php
                                          $user = Auth::user();
                                    @endphp
                                    @if($user->profile!=null)
                                     <img
                                        draggable="false"
                                        src="{{URL::to('images/profile/'.$user->profile)}}"
                                        alt="mdo"
                                        class="rounded-circle"
                                    />
                                    @else
                                    <img
                                        draggable="false"
                                        src="{{URL::to('images/default/pro.jpg')}}"
                                        alt="mdo"
                                        class="rounded-circle"
                                    />
                                    @endif
                                </a>
                                <div
                                    class="dropdown-menu"
                                    aria-labelledby="profileDropdown"
                                >
                                    <a
                                        class="dropdown-item"
                                        href="{{ url('/') }}"
                                        >Home</a
                                    >
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('user.my.profile') }}"
                                        >My Profile</a
                                    >
                                    <a
                                        class="dropdown-item border-0"
                                        href="{{ route('user.logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        Logout
                                    </a>
                                    <form
                                        id="logout-form"
                                        action="{{ route('user.logout') }}"
                                        method="POST"
                                        style="display: none"
                                    >
                                        @csrf
                                    </form>
                                </div>
                                @else
                                <div class="account_warp">
                                    <i class="bi bi-person-fill"></i>
                                    <div class="">
                                        <a
                                            class="heading_style"
                                            href="{{ route('user.login') }}"
                                        >
                                            Account
                                        </a>
                                        <p>
                                            <a href="{{ route('user.login') }}"
                                                >Login</a
                                            >
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </header>
        {{-- Mobile Menu --}}
        <div
            class="offcanvas offcanvas-start mobile_menu"
            tabindex="-1"
            id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel d-print-none"
        >
            <div class="offcanvas-header">
                <img
                    src="{{URL::to('frontend/images/logo.png')}}"
                    class="img-fluid"
                    alt=""
                />
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                ></button>
            </div>
            <div class="mobile_menu_item_wrap">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        <a href="{{ route('frontend.all.product') }}"
                            >Products</a
                        >
                    </li>
                    <li><a href="{{ route('user.about.us') }}">About</a></li>
                    <li>
                        <a href="{{ route('user.contact.us') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <main
            class="main_website_wrapper"
            style="background-image: url('{{URL::to('frontend/images/page_bg.png')}}')"
        >
            @yield('content')
            <!-- Follow us on -->

            @php
             $siteSetting = App\Models\SiteSetting::first();
            @endphp
            <section class="follow_us_section text-center d-print-none">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="follow_us">
                                <h2>Follow us on</h2>
                                <ul>
                                    <li data-aos="fade-up">
                                        <a href="{{$siteSetting->facebook_link ? $siteSetting->facebook_link:''}}" target="_blank">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                    </li>
                                    <li data-aos="fade-up" data-aos-delay="200">
                                        <a href="{{$siteSetting->instagram_link ? $siteSetting->instagram_link:''}}" target="_blank">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </li>
                                    <li data-aos="fade-up" data-aos-delay="400">
                                        <a href="{{$siteSetting->whatsapp_link ? $siteSetting->whatsapp_link:''}}" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
       <footer class="site_footer_wrapper d-print-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="footer_item footer_logo">
                            <a href="index.html">
                                <img
                                    draggable="false"
                                    src="{{URL::to('frontend/images/logo.png')}}"
                                    alt="wings keep flyings"
                                    class="img-fluid"
                                />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">

                            @if(!empty($siteSetting))
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <div class="footer_item">
                                    <h3>Contact Info</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul>
                                                <li>
                                                    <i
                                                        class="bi bi-geo-alt-fill"
                                                    ></i>
                                                    <a href="#"
                                                        >{{$siteSetting->address ? $siteSetting->address:''}}</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="contact_info">
                                                <li>
                                                    <i
                                                        class="bi bi-envelope-fill"
                                                    ></i>
                                                    <a href="#"
                                                        >{{$siteSetting->email}}</a
                                                    >
                                                </li>
                                                <li>
                                                    <i
                                                        class="bi bi-telephone-fill"
                                                    ></i>
                                                    <a href="#"
                                                        >+88{{$siteSetting->phone}}</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="footer_item">
                                    <h3>Others Info</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route(
                                                                'user.about.us'
                                                            )
                                                        }}"
                                                        >About Us</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route(
                                                                'user.contact.us'
                                                            )
                                                        }}"
                                                        >Contact Us</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route(
                                                                'user.terms.condition'
                                                            )
                                                        }}"
                                                        >Terms & Conditions</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route(
                                                                'user.privacy.policy'
                                                            )
                                                        }}"
                                                        >Privacy Policy</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route(
                                                                'user.return.policy'
                                                            )
                                                        }}"
                                                        >Return & Exchange</a
                                                    >
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{
                                                            route('user.faq')
                                                        }}"
                                                        >FAQs</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <a
            href="#"
            class="scroll-top d-flex align-items-center justify-content-center active"
        >
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <script src="{{
                asset('frontend/plugin/jquery/jquery-3.5.1.min.js')
            }}"></script>
        <script src="{{
                asset('frontend/plugin/bootstrap/bootstrap.bundle.min.js')
            }}"></script>
        <script src="{{ asset('frontend/plugin/aos/aos.js') }}"></script>
        <script src="{{
                asset('frontend/plugin/swiper/swiper-bundle.min.js')
            }}"></script>
        <script src="{{
                asset('frontend/plugin/easyzoom/easyzoom.js')
            }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
    </body>
</html>
