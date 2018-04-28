@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.dashboard')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.dashboard')</li>
        </ol>
    </div>
    <div class="col-md-7 align-self-center">
        {!! Form::button() !!}
        <a href="https://wrappixel.com/templates/adminwrap/" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down"> Upgrade to Pro</a>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div>
                        <h5 class="card-title m-b-0">Sales Chart</h5>
                    </div>
                    <div class="ml-auto">
                        <ul class="list-inline text-center font-12">
                            <li><i class="fa fa-circle text-success"></i> SITE A</li>
                            <li><i class="fa fa-circle text-info"></i> SITE B</li>
                            <li><i class="fa fa-circle text-primary"></i> SITE C</li>
                        </ul>
                    </div>
                </div>
                <div class="" id="sales-chart" style="height: 355px;"></div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-30 no-block">
                    <h5 class="card-title m-b-0 align-self-center">Our Visitors</h5>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option selected="">Today</option>
                            <option value="1">Tomorrow</option>
                        </select>
                    </div>
                </div>
                <div id="visitor" style="height:260px; width:100%;"></div>
                <ul class="list-inline m-t-30 text-center font-12">
                    <li><i class="fa fa-circle text-purple"></i> Tablet</li>
                    <li><i class="fa fa-circle text-success"></i> Desktops</li>
                    <li><i class="fa fa-circle text-info"></i> Mobile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Sales Chart -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Projects of the Month -->
<!-- ============================================================== -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h5 class="card-title">Projects of the Month</h5>
                    </div>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option selected="">January</option>
                            <option value="1">February</option>
                            <option value="2">March</option>
                            <option value="3">April</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive m-t-20 no-wrap">
                    <table class="table vm no-th-brd pro-of-month">
                        <thead>
                            <tr>
                                <th colspan="2">Assigned</th>
                                <th>Name</th>
                                <th>Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:50px;"><span class="round">S</span></td>
                                <td>
                                    <h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>
                                <td>Elite Admin</td>
                                <td>$3.9K</td>
                            </tr>
                            <tr class="active">
                                <td><span class="round"><img src="../assets/images/users/2.jpg" alt="user" width="50"></span></td>
                                <td>
                                    <h6>Andrew</h6><small class="text-muted">Project Manager</small></td>
                                <td>Real Homes</td>
                                <td>$23.9K</td>
                            </tr>
                            <tr>
                                <td><span class="round round-success">B</span></td>
                                <td>
                                    <h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>
                                <td>MedicalPro Theme</td>
                                <td>$12.9K</td>
                            </tr>
                            <tr>
                                <td><span class="round round-primary">N</span></td>
                                <td>
                                    <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>
                                <td>Elite Admin</td>
                                <td>$10.9K</td>
                            </tr>
                            <tr>
                                <td><span class="round round-warning">M</span></td>
                                <td>
                                    <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>
                                <td>Helping Hands</td>
                                <td>$12.9K</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-4">
        <div class="card">
            <div class="up-img" style="background-image:url(../assets/images/big/img1.jpg)"></div>
            <div class="card-body">
                <h5 class=" card-title">Business development of rules</h5>
                <span class="label label-info label-rounded">Technology</span>
                <p class="m-b-0 m-t-20">Titudin venenatis ipsum aciat. Vestibu ullamer quam. nenatis ipsum ac feugiat. Ibulum ullamcorper.</p>
                <div class="d-flex m-t-20">
                    <a class="link" href="javascript:void(0)">Read more</a>
                    <div class="ml-auto align-self-center">
                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart-o"></i></a>
                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-share-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
