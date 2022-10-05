<!DOCTYPE html>
<html>
<head>
    <title>Bookfromcard.com</title>
</head>
<body>
    <h1>Hi [{{ $details['email'] }}]</h1>
    <h2>There was a request to change your password!</h2>
    <h3>Otp is : {{ $details['password'] }}</h3>
    
    <br/>
    
    <p>Please do not reply to this email. Emails sent to this address will not be answered.</p>   
    
</body>
</html>