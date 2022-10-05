@include('common.header')
<section class="section profile mt-120">
    <div class="row m-5">

        <div class="col-12">
            @if(Session::has('message'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if(Session::has('errormessage'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('errormessage') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endforeach
            @endif
            <div class="card">
                <div class="card-body pt-3">
                <form action="{{route('profile_update.user')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="fullName"
                                            value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone"
                                            value="{{$user->phone}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" disabled
                                            value="{{$user->email}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Referal Url</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="Linkedin"
                                            value="{{url('register/'.$user->referral_token)}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="text" class="form-control"
                                            placeholder="Enter Your New Password">
                                    </div>
                                </div>
                                <input type="hidden" name="hiddenid" value="{{$user->id}}" class="form-control"
                                    required>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                    <!-- Bordered Tabs -->
                    <!-- <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</a>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Receive</th>
                                        <th scope="col">Earn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $list)
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage/'.$list->product_img)}}" alt=""
                                                    width="80"></td>
                                        <td><a href="#" class="text-primary fw-bold">{{$list->product_name}}</a></td>
                                        <td>₹ {{$list->product_price}}</td>
                                        <td class="fw-bold">₹ {{$list->product_price + $list->commission}}</td>
                                        <td>₹ {{$list->commission}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <form action="{{route('profile_update.user')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="fullName"
                                            value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone"
                                            value="{{$user->phone}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" disabled
                                            value="{{$user->email}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Referal Url</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="text" class="form-control" id="Linkedin"
                                            value="{{url('register/'.$user->referral_token)}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="text" class="form-control"
                                            placeholder="Enter Your New Password">
                                    </div>
                                </div>
                                <input type="hidden" name="hiddenid" value="{{$user->id}}" class="form-control"
                                    required>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>

                        </div>

                    </div> -->

                </div>
            </div>

        </div>
    </div>
</section>
@include('common.footer')