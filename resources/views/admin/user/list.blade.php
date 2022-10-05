@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users</h1>
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
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Referal Bonus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $list)
                                <tr>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->phone}}</td>
                                    <td>{{$list->email}}</td>
                                    <td>{{$list->commission}}</td>
                                    <td>
                                        <a href="{{url('own-cms/users/order/'.$list->id)}}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i></a>
                                        <a href="{{url('own-cms/users/delete/'.$list->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></a>
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