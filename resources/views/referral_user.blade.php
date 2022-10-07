@include('common.header')
<section class="refernearn-user-dash">
    <div class="container">
        <div class="rne-dash-head">
            <p class="text-center">Refer friend and earn ₹50 EVERYTIME they shop!</p>
            <div class="row rne-user-dash">
                <div class="col-6 text-center br-right">
                    <h4>{{50*$total}}</h4>
                    <p>Total Referral<br />Cashback Earned</p>
                </div>
                <div class="col-6 text-center">
                    <h4>{{$total}}</h4>
                    <p>Friends Joined</p>
                </div>
            </div>
        </div>
        <div class="rne-dash-content">
            @if(count($data)>0)
            <h4 class="text-left">My Network</h4>
            <div class="rne-user-network">
                @foreach($data as $list)
                <table>
                    <thead>
                        <tr>
                            <td>Referral Name</td>
                            <td>Referral Model Name</td>
                            <td>Referral Earnings</td>
                            <td>Referral Transcation</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ucfirst(get_user($list->user_id)->name)}}</td>
                            <td>{{$list->product_name}}</td>
                            <td>₹ 50</td>
                            <td>{{date('d M Y', strtotime($list->created_at))}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            @else
            <h4 class="title text-warning">Sorry no Referral User is available right now</h4>
            @endif
        </div>

    </div>
</section>
@include('common.footer')