@extends('user.app')
@section('content')
	<section class="user_auth_wrapper">
        <div class="container">
            <div class="user_auth theme_ws_box">
                <form method="post" action="#">
                    @csrf
                    <h2 class="title text-center">Account Information</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Account No</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account"
                                    name="account"
                                    required
                                    placeholder="Enter Account No"
                                />
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn_style w-100">Payment</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
