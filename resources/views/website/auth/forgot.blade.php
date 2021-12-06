@extends('layout.website.auth')

@section('title', 'Forgot Password')

@section('main')

    <section class="login-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="forget-div">
                        <div class="login-logo"><img src="{{ asset('asset_website/img/home/logo.png') }}"
                                class="w100"></div>
                        <a onclick="goBack()" class="page-close"><span class="icon-cancel-30"></span></a>
                        <div class="forget-cover">
                            <form class="row" action="">
                                <div class="col-lg-12">
                                    <h4 class="small-heading-grey">Forgot Password</h4>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="text" class="form-control" placeholder="Enter Email address" id="email">
                                </div>

                                <div class="form-group mb0 col-lg-12">
                                    <a href="{{ route('website.new.password') }}"
                                        class="btn btn-block login-btn">Continue</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('script')
@endsection

</body>

</html>
