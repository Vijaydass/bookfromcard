@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Banks</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a href="{{url('own-cms/banks')}}" class="btn btn-primary btn-sm">+ Add Bank</a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Custom Styled Validation</h5>
                        @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                        @endif
                        <!-- Custom Styled Validation -->
                        <form class="row g-3 needs-validation" novalidate action="{{route('bank.insert')}}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Bank name</label>
                                <input type="text" class="form-control" name="bank_name" id="validationCustom01"
                                    required>
                                @if ($errors->has('bank_name'))
                                <div class="valid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="bank_img" class="form-label">Bank Image</label>
                                <input type="file" class="form-control" name="bank_img" id="bank_img" required>
                                @if ($errors->has('bank_img'))
                                <div class="valid-feedback">
                                    {{ $errors->first('bank_img') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>

                </div>
            </div><!-- End Top Selling -->
        </div>
    </section>

</main><!-- End #main -->
@include('admin.common.footerscript')
@include('admin.common.footer')