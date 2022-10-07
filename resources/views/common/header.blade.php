@include('common.head')

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('/logo.png')}}" alt=""></a>
                </div>
                <div class="header-right">

                </div>
                <div class="user-access">
                    @if(Auth::guest())
                    <a href="{{url('/register')}}">Register</a>
                    <a class="in" href="#" onClick="loginModal()">Sign in</a>
                    @endif
                </div>
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a class="active" href="{{url('/')}}">Home</a></li>
                        @if(Auth::check())
                        <li><a href="{{url('/profile')}}">Profile</a></li>
                        <li><a href="{{url('/user-orders')}}">Orders</a>
                        </li>
                        <li><a href="{{url('/refer_earn')}}"> Refer &
                                Earn</a></li>
                        <li><a href="{{url('/referral_user')}}"> Referral
                                User</a></li>
                        <li><a href="{{route('user.logout')}}">Logout</a>
                        </li>
                        @endif                        
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Header End -->