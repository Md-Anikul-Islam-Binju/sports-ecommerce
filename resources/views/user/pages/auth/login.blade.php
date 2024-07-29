@extends('user.app')
@section('content')
    <!-- Login -->
    <section class="user_auth_wrapper">
        <div class="container">
            <div class="user_auth theme_ws_box">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('user.login.account') }}">
                    @csrf
                    <h2 class="title text-center">User Login</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    required
                                    name="email"
                                    placeholder="Enter your email*"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    required
                                    name="password"
                                    placeholder="Enter your password*"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button
                                    type="submit"
                                    class="btn_style w-100"
                                >
                                    Login
                                </button>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <p>
                                Don't have an account? <a href="{{ route('user.register') }}" class="text-decoration-underline">Register</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
