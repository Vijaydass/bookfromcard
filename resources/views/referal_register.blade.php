@include('common.header')
<section class="mt-150 mb-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="name" />
                                @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" />
                                @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" name="phone" class="form-control" placeholder="phone number" />
                                @if ($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" />
                                @if ($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password Confirm</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Password Confirmation" />
                            </div>
                            <input type="hidden" name="referal_code" class="form-control" value="{{$referal_code}}" />
                            <button class="btn btn-primary btn-block mt-3">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('common.footer')