@extends('layout.admin.layout.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">$ 15,0000</h2>
                <h6 class="card-text">Increased by 60%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">45,6334</h2>
                <h6 class="card-text">Decreased by 10%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">95,5741</h2>
                <h6 class="card-text">Increased by 5%</h6>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->hasRole('Teacher'))
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Become a teacher</h4>
            <form class="forms-sample">
                <p class="card-description"> Personal Details </p>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputContact">Contact Number</label>
                        <input type="text" class="form-control" id="inputContact" placeholder="Contact number">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Gender</label>
                        <select class="form-control" id="exampleSelectGender">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                </div>

                <h4 class="card-title">Professional Details</h4>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="exampleInputCity1">Total Experience</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleTextarea1">Course applying for</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="exampleTextarea1">10th Percentage</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleTextarea1">12th Percentage</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Highest Qualification</label>
                    <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="currentOrganization">Current organization</label>
                        <input type="text" class="form-control" id="currentOrganization"
                            placeholder="Current Organinzation">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ciurrentDesignation">Current Designation</label>
                        <input type="email" class="form-control" id="ciurrentDesignation"
                            placeholder="Current Designation">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="currentCTC">Current CTC</label>
                        <input type="text" class="form-control" id="currentCTC" placeholder="Current Organinzation">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>Upload resume</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Upload resume:</label>
                    <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection