
<img src="{{ asset('bogota_credit_union_logo.png') }}" width="120">

<h3>Hello {{ $name }},</h3>

<h4>A credit transaction was made to your account.</h4><br>

<strong>Transaction Details</strong><br>
<p><strong>Account Number:</strong> {{ $accnum }}</p>
<p><strong>Description:</strong> {{ $description }}</p>
<p><strong>Amount:</strong> ${{ $amt }}</p>
<p><strong>Date of Transaction:</strong> {{ $time }}</p>
<p><strong>Fund Transfer Type:</strong> International Transfer</p>
<p><strong>Transaction Reference Number:</strong> {{ $ref }}</p>
<p><strong>Transaction Description:</strong> {{ $trans_desc }}</p><br>

<strong>The balance of your account as at {{ $time }}</strong><br>
<p><strong>Current Balance:</strong> ${{ number_format($accbal, 0) }}</p><br><br>


<p><strong>Email:</strong>  info@bogotacreditunion.com</p>
