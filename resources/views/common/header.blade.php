
@include('common.head')
<body>    
    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{asset('/logo.png')}}" alt="Logo" width="100">
                        </a>
                        @if(Auth::check())
                        <a class="navbar-toggler text-white" style="border: #ffffffb5 2px solid;" href="{{route('user.logout')}}" ><i class="lni lni-exit text-white"></i></a>
                        @endif
                        @if(Auth::guest())
                        <a class="navbar-toggler text-white" style="border: #ffffffb5 2px solid;" href="#" onClick="loginModal()"><i class="lni lni-enter text-white"></i></a>
                        @endif
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo"
                            aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation" style="width: auto;">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="{{url('/')}}">home</a></li>
                                @if(Auth::check())
                                <li class="nav-item"><a class="page-scroll" href="{{url('/profile')}}">Profile</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/user-orders')}}">Orders</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/refer_earn')}}"> Refer & Earn</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/referral_user')}}"> Referral User</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{route('user.logout')}}">Logout</a></li>                                
                                @endif
                                @if(Auth::guest())
                                <li class="nav-item"><a class="page-scroll" href="#" onClick="loginModal()">Login</a></li>
                                <li class="nav-item"><a class="page-scroll" href="{{url('/register')}}">Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>