@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <main class="main">
        <div class="ps-page--single">
            <div class="ps-breadcrumb">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li><a href="#">Vendor Pages</a></li>
                        <li>Vendor Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ps-vendor-dashboard">
            <div class="container">
                <div class="ps-section__header">
                    <h3>Vendor Dasboard</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate corporis saepe, quod quos vitae a! Repellat ratione magnam nulla doloribus libero veritatis, itaque sit veniam? Adipisci odit animi officiis? Neque.</p>
                </div>
                <div class="ps-section__content">
                    <ul class="ps-section__links">
                        <li class="active"><a href="#">Dashboard</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Order</a></li>
                        <li><a href="#">Setting</a></li>
                        <li><a href="#">View Store</a></li>
                    </ul>
                    <div class="ps-block--vendor-dashboard">
                        <div class="ps-block__header">
                            <h3>Sale Report</h3>
                        </div>
                        <div class="ps-block__content">
                            <form class="ps-form--vendor-datetimepicker" action="http://nouthemes.net/html/martfury/index.html" method="get">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text" id="time-from">From</span></div>
                                            <input class="form-control" aria-label="Username" aria-describedby="time-from">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text" id="time-form">To</span></div>
                                            <input class="form-control" aria-label="Username" aria-describedby="time-to">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                                        <button class="ps-btn"><i class="icon-sync2"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table ps-table ps-table--vendor">
                                    <thead>
                                        <tr>
                                            <th>date</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Sold</th>
                                            <th>Commission</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nov 4, 2019</td>
                                            <td><a href="#">Marshall Kilburn Portable Wireless Bluetooth Spe...</a></td>
                                            <td>$235.35</td>
                                            <td>25</td>
                                            <td>$2940.00</td>
                                            <td>24.5%</td>
                                        </tr>
                                        <tr>
                                            <td>Nov 4, 2019</td>
                                            <td><a href="#">Unero Military Classical Backpack</a></td>
                                            <td>$42.35</td>
                                            <td>10</td>
                                            <td>$211.00</td>
                                            <td>17.5%</td>
                                        </tr>
                                        <tr>
                                            <td>Nov 4, 2019</td>
                                            <td><a href="#">Sleeve Linen Blend Caro Pana T-Shirt</a></td>
                                            <td>$23.35</td>
                                            <td>80</td>
                                            <td>$935.00</td>
                                            <td>62.5%</td>
                                        </tr>
                                        <tr>
                                            <td>Nov 30, 2019</td>
                                            <td><a href="#">Harman Kardon Onyx Studio 2.0</a></td>
                                            <td>$299.35</td>
                                            <td>14</td>
                                            <td>$2095.00</td>
                                            <td>62.5%</td>
                                        </tr>
                                        <tr>
                                            <td>Nov 30, 2019</td>
                                            <td><a href="#">Korea Long Sofa Fabric In Blu Navy Color</a></td>
                                            <td>$299.35</td>
                                            <td>5</td>
                                            <td>$6095.00</td>
                                            <td>62.5%</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Total</strong></td>
                                            <td><strong>124 Sale</strong></td>
                                            <td colspan="2"><strong>$12.104.725</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="ps-block--vendor-dashboard">
                        <div class="ps-block__header">
                            <h3>Recent Orders</h3>
                        </div>
                        <div class="ps-block__content">
                            <div class="table-responsive">
                                <table class="table ps-table ps-table--vendor">
                                    <thead>
                                        <tr>
                                            <th>date</th>
                                            <th>Order ID</th>
                                            <th>Shipping</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nov 4, 2019</td>
                                            <td><a href="#">MS46891357</a></td>
                                            <td>$00.00</td>
                                            <td>$295.47</td>
                                            <td><a href="#">Open</a></td>
                                            <td><a href="#">View Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Nov 2, 2017</td>
                                            <td><a href="#">AP47305441</a></td>
                                            <td>$00.00</td>
                                            <td>$25.47</td>
                                            <td>Close</td>
                                            <td><a href="#">View Detail</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection