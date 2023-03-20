<title>Dasbor &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h3 class="card-title text-white">Baik</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">50</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-check-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <h3 class="card-title text-white">Rusak Ringan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">4</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-warning"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <h3 class="card-title text-white">Rusak Berat</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">1</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-times-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">60</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-pie-chart"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset</h4>
                    <div id="pie-chart2" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset</h4>
                    <div id="pie-chart2" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="./images/users/8.jpg" class="rounded-circle" alt="">
                        <h5 class="mt-3 mb-1">Ana Liem</h5>
                        <p class="m-0">Senior Manager</p>
                        <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="./images/users/5.jpg" class="rounded-circle" alt="">
                        <h5 class="mt-3 mb-1">John Abraham</h5>
                        <p class="m-0">Store Manager</p>
                        <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="./images/users/7.jpg" class="rounded-circle" alt="">
                        <h5 class="mt-3 mb-1">John Doe</h5>
                        <p class="m-0">Sales Man</p>
                        <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="./images/users/1.jpg" class="rounded-circle" alt="">
                        <h5 class="mt-3 mb-1">Mehedi Titas</h5>
                        <p class="m-0">Online Marketer</p>
                        <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Kondisi Barang Rusak Ringan</h4>
                    <div class="active-member">
                        <div class="table-responsive">
                            <table class="table table-xs mb-0">
                                <thead>
                                    <tr>
                                        <th>Customers</th>
                                        <th>Product</th>
                                        <th>Country</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="./images/avatar/1.jpg" class=" rounded-circle mr-3" alt="">Sarah Smith</td>
                                        <td>iPhone X</td>
                                        <td>
                                            <span>United States</span>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./images/avatar/2.jpg" class=" rounded-circle mr-3" alt="">Walter R.</td>
                                        <td>Pixel 2</td>
                                        <td><span>Canada</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">50 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./images/avatar/3.jpg" class=" rounded-circle mr-3" alt="">Andrew D.</td>
                                        <td>OnePlus</td>
                                        <td><span>Germany</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./images/avatar/6.jpg" class=" rounded-circle mr-3" alt=""> Megan S.</td>
                                        <td>Galaxy</td>
                                        <td><span>Japan</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./images/avatar/4.jpg" class=" rounded-circle mr-3" alt=""> Doris R.</td>
                                        <td>Moto Z2</td>
                                        <td><span>England</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-success" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="./images/avatar/5.jpg" class=" rounded-circle mr-3" alt="">Elizabeth W.</td>
                                        <td>Notebook Asus</td>
                                        <td><span>China</span></td>
                                        <td>
                                            <div>
                                                <div class="progress" style="height: 6px">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                        <td>
                                            <span>Last Login</span>
                                            <span class="m-0 pl-3">10 sec ago</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">

            <div class="card">
                <div class="chart-wrapper mb-4">
                    <div class="px-4 pt-4 d-flex justify-content-between">
                        <div>
                            <h4>Sales Activities</h4>
                            <p>Last 6 Month</p>
                        </div>
                        <div>
                            <span><i class="fa fa-caret-up text-success"></i></span>
                            <h4 class="d-inline-block text-success">720</h4>
                            <p class=" text-danger">+120.5(5.0%)</p>
                        </div>
                    </div>
                    <div>
                        <canvas id="chart_widget_3"></canvas>
                    </div>
                </div>
                <div class="card-body border-top pt-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul>
                                <li>5% Negative Feedback</li>
                                <li>95% Positive Feedback</li>
                            </ul>
                            <div>
                                <h5>Customer Feedback</h5>
                                <h3>385749</h3>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="chart_widget_3_1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Activity</h4>
                    <div id="activity">
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/1.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>Received New Order</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>iPhone develered</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>3 Order Pending</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>Join new Manager</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>Branch open 5 min Late</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media border-bottom-1 pt-3 pb-3">
                            <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>New support ticket received</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                        <div class="media pt-3 pb-3">
                            <img width="35" src="./images/avatar/3.jpg" class="mr-3 rounded-circle">
                            <div class="media-body">
                                <h5>Facebook Post 30 Comments</h5>
                                <p class="mb-0">I shared this on my fb wall a few months back,</p>
                            </div><span class="text-muted ">April 24, 2018</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-sm-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Store Location</h4>
                    <div id="world-map" style="height: 470px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection