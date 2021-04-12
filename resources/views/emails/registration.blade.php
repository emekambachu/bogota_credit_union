
<img src="{{ asset('bogota_credit_union_logo.png') }}" width="100">

<h3>Registration Complete</h3>

<h3>Hello {{ $fname }} {{ $lname }},</h3>

<p>
Thank you for signing up for a {{ $acctype }} with Bogota Credit Union, Below are your login details and account number.<br>

    <strong>Your account will be active as soon as it's verified</strong><br><br>

    <strong>Account Number:</strong> {{ $accnum }}<br>

    <strong>Account Type:</strong> {{ $acctype }}<br>

    <strong>Email:</strong> {{ $email  }}<br>

    <strong>Pin code:</strong> {{ $pin }}
</p><br><br>

<p><strong>Email:</strong>  info@bogotacreditunion.com</p>
