@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Address</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a href="{{url('own-cms/address')}}" class="btn btn-primary btn-sm">Address</a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Address</h5>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endforeach
                        @endif
                        <!-- Custom Styled Validation -->
                        <form class="row g-3" action="{{route('address.insert')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>

                            <div class="col-md-6">
                                <label>Address</label>
                                <textarea rows="3" cols="" name="address"
                                        class="form-control" placeholder="Enter  address"></textarea>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-success">Save</button>
                                <a href="#" class="btn btn-warning">Reset</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div><!-- End Top Selling -->
        </div>
    </section>

</main><!-- End #main -->
@include('admin.common.footerscript')
@include('admin.common.footer')