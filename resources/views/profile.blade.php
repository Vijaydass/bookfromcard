@include('common.header')
<!-- Latest Product Begin -->
<section class="my-account">
    <div class="container">
        <div class="profile-intro mb-4">
            <h2 class="Page-title">My Account</span></h2>
            <p>Hello {{$user->name}},<br />
                You can manage your profile here.</p>
            <div class="static-pp">
                <figure>
                    <img src="img/user.png" alt="">
                </figure>
            </div>
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
        </div>
        <div class="row mb-4 g-4">
            <div class="col-12 col-lg-3 d-none d-sm-block">
            </div>
            <div class="col-12 col-lg-6 profile-edit">
            <form action="{{route('profile_update.user')}}" method="POST">
                        @csrf
                    <div class="">
                        <label>Full Name</label>
                        <input name="name" type="text" value="{{$user->name}}">
                    </div>
                    <div class="">
                        <label>Phone</label>
                        <input name="phone" type="text" value="{{$user->phone}}">
                    </div>
                    <div class="">
                        <label>Email</label>
                        <input name="email" type="email" disabled
                                    value="{{$user->email}}">
                    </div>
                    <div class="">
                        <label>New Password</label>
                        <input name="password" type="text" placeholder="Enter Your New Password">
                    </div>
                    <input type="hidden" name="hiddenid" value="{{$user->id}}" class="form-control" required>
                    <button class="site-btn">Update Profile</button>
                </form>
            </div>
            <div class="col-12 col-lg-3 d-none d-sm-block">
            </div>
        </div>
    </div>
</section>
<!-- Latest Product End -->
@include('common.footer')