@extends('layout.website.auth')

@section('title', 'New Password')

@section('main')

    <section class="login-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newpass-div">
                        <div class="login-logo"><img src="{{ asset('asset_website/img/home/logo.png') }}"
                                class="w100"></div>
                        <a onclick="goBack()" class="page-close"><span class="icon-cancel-30"></span></a>
                        <div class="forget-cover">
                            <form class="row" action="">
                                <div class="col-lg-12">
                                    <h4 class="small-heading-grey">New Password</h4>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="text" class="form-control" placeholder="New Password" id="pass">
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="text" class="form-control" placeholder="Confirm Password" id="c_pass">
                                </div>

                                <div class="form-group mb0 col-lg-12">
                                    <button type="submit" class="btn btn-block login-btn">Change</button>
                                    <p>Please Creat a new Password that you
                                        don’t use on any other site</p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection

</body>

</html>
