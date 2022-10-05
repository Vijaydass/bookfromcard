@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Product <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$total_product}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Orders <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$total_orders}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">                

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$total_user}}</h6> 
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">              

                <div class="card-body">
                  <h5 class="card-title">Recent Orders <span>| Latest</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#Order Number</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Commission</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $list)
                      <tr>
                        <th scope="row"><a href="#">#{{$list->order_number}}</a></th>
                        <td>{{$list->name}}</td>
                        <td><a href="#" class="text-primary">{{$list->product_name}}</a></td>
                        <td>₹ {{$list->product_price}}</td>
                        <td><span class="badge bg-success">₹ {{$list->commission}}</span></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                

                <div class="card-body pb-0">
                  <h5 class="card-title">Products <span>| Latest</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Commission</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $list)
                      <tr>
                        <th scope="row"><img src="{{asset('storage/'.$list->image)}}" alt=""></th>
                        <td><a href="#" class="text-primary fw-bold">{{$list->name}}</a></td>
                        <td>₹ {{$list->price}}</td>
                        <td class="fw-bold">{{$list->quantity}}</td>
                        <td>₹ {{$list->commission}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
@include('admin.common.footerscript')
@include('admin.common.footer')