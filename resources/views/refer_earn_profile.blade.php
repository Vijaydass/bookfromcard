@include('common.header')
<section class="refernearn">
    <div class="container">
        <div class="row rne">
            <div class="col-12 text-center">
                <div class="rne-block">
                    <h4 class="text-sm-center m-3">Your Referral Link</h4>
                    <p>Make your friends join bookfromcards via your referral link below - No referral code needed</p>
                    <div class="referral-link">{{url('register/'.$user->referral_token)}}</div>
                </div>
            </div>
        </div>
        <div class="rne-bottom">
            <img src="{{asset('assets/img/reefernearn-bottom.png')}}" alt="refer and earn" />
        </div>
    </div>
</section>
@include('common.footer')
<script>
function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}
</script>