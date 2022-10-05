@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">
                        <h5 class="card-title">List</h5>
                        @if(Session::has('message'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Receive</th>
                                    <th scope="col">Earn</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $list)
                                <tr>
                                    <td><a href="#" class="text-primary fw-bold">{{$list->name}}</a></td>
                                    <td><a href="#" class="text-primary fw-bold">{{$list->phone}}</a></td>
                                    <td><a href="#" class="text-primary fw-bold">{{$list->product_name}}</a></td>
                                    <th scope="row">
                                        <img src="{{asset('storage/'.$list->product_img)}}">
                                    </th>                                    
                                    <td><a href="#" class="text-primary fw-bold {{$list->delivery_status?$list->delivery_status==='delivered':'text-success'}}">{{Str::ucfirst($list->delivery_status)}}</a></td>
                                    <td><a href="#" class="text-primary fw-bold {{$list->payment_status?'text-success':'text-danger'}}">{{$list->payment_status?Str::ucfirst($list->payment_status):'Not Paid'}}</a></td>
                                    <td><a href="#" class="text-primary fw-bold">₹ {{$list->product_price}}</a></td>
                                    <td class="fw-bold">₹ {{$list->product_price + $list->commission}}</td>
                                    <td><a href="#" class="text-primary fw-bold">₹ {{$list->commission}}</a></td>
                                    <td>
                                        <a href="{{url('own-cms/orders/show/'.$list->order_id)}}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i></a>                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Top Selling -->
        </div>
    </section>

</main><!-- End #main -->
@include('admin.common.footerscript')
@include('admin.common.footer')