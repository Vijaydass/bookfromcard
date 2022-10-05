@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Orders</h5>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Bonus Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $list)
                                <tr>
                                    <td><a href="#" class="text-primary fw-bold">{{date('d M Y', strtotime($list->created_at))}}</a>
                                    <td><a href="#" class="text-primary fw-bold">{{get_user($list->user_id)->name}}</a>
                                    <td><a href="#" class="text-primary fw-bold">{{$list->tracking_id}}</a>
                                    <td><a href="#" class="text-primary fw-bold">₹ {{$list->commission}}</a>
                                    <td>
                                        <a href="{{url('own-cms/orders/show/'.$list->id)}}" class="btn btn-sm btn-primary"><i
                                                class="bi bi-eye"></i></a>                                        
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