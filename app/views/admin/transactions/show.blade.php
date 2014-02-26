<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Invoice</title>

</head>

<body style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;color: #333;line-height: 14px;">
<div id="invoice" style="background-color: #FFF;margin: auto;width: 750px;min-height: 800px;">
  <div id="invoice-inner" style="padding: 10px;">
    <div style="background-color: #000; line-height:30px; font-size: 24px;display: block;text-align: center;color: #FFF;text-transform: uppercase;margin-bottom: 25px;">Invoice</div>
    <table style="none;border-collapse: collapse;padding: 10px;width: 100%;">
    <tr>
      <td style="none;border-collapse: collapse;padding: 10px; width:50%;">
          <p style="line-height: 24px;">Unit 736 Cityland Mega Plaza, ADB Ave.<br>Ortigas, Pasig City<br>Telephone: 667-3511  to 12</p>
      </td>
      <td style="none; border-collapse: collapse;padding: 10px;text-align:right;">
          <img src="{{ URL::to('logo.png') }}">
      </td>
    </tr>
    <tr>
        <td style="none;border-collapse: collapse;padding: 10px;">
              <p style="line-height: 24px;"><strong>Customer: {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</strong><br>{{ nl2br(join(" ",json_decode($transaction->user->work_address))) }}</p>
        </td>
        <td style="none; border-collapse: collapse;padding: 10px; text-align:right;">
              <p style="line-height: 24px;"><strong>Invoice Number #</strong>: {{ $transaction->reference_number }}<br>
              <strong>Amount: Php</strong> {{ number_format($transaction->amount,2) }}<br>
              <strong>Date:</strong> {{ date("F j,Y",strtotime($transaction->updated_at)) }}</p>
        </td>
        </tr>
    </table>
      <div style="clear:both;"></div>
      <div id="invoice-table">
    <table id="items" style="border: 1px solid black;border-collapse: collapse;padding: 10px;width: 100%;">
    
      <tr>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Item</th>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Model</th>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Description</th>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Unit Cost</th>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Quantity</th>
          <th style="border: 1px solid black;border-collapse: collapse;padding: 10px;background-color: #000;color: white;">Price</th>
      </tr>
      <tr>
          <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">
              {{ $transaction->reference_number }}
          </td>
           <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">{{ $property->model_number }} - {{ $property->name }} </td>
          <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">{{ $transaction->remarks }}</td>
          <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">Php{{ number_format($transaction->amount,2) }}</td>
          <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">1</td>
          <td style="border: 1px solid black;border-collapse: collapse;padding: 10px;">Php{{ number_format($transaction->amount,2) }}</td>
      </tr>
          </table>
          <h3 align="right"><strong>Total Amount: Php{{ number_format($transaction->amount,2) }}</strong></h3>
      </div>
      <br>
      <div class="rule" style="background-color: #000; line-height:30px;font-size: 24px;display: block;text-align: center;color: #FFF;text-transform: uppercase;margin-bottom: 25px;">Billing Information</div>
<p>Acct. holder: Live n&rsquo; Love Realty  Corporation<br />
  Acct. holder address: 736 City and Mega  Plaze ADB Avenue, Ortigas Center, Pasig City<br />
  Acct holder telephone: 667-3511<br />
  Bank Name: Asia United Bank<br />
  Bank Branch: Ortigas Pasig City<br />
  Bank Add.: ADB Avenue Ortigas Pasig City<br />
  Bank Telephone:<br />
  Bank Acct. No.: 2120682717<br />
  Currency: Philippine Peso</p>
<p>REMINDER: The Following Requirements Must  Be Provided.</p>
<ul>
  <li>One month payslip(latest)</li>
  <li>Birth Certificate / Marriage  Contract</li>
  <li>ITR – income tax return</li>
  <li>Certificate of employment and  compensation – notarized – original</li>
  <li>MSVS pag-ibig</li>
  <li>Proof of billing meralco /  water / credit card billing</li>
  <li>ID</li>
  <li>Cedula</li>
  <li>4 pcs. 1x1 picture</li>
  <li>PDC (post-dated checks)</li>
  <li>Special Power of Attorney</li>
</ul>
<p>For further information please contact us. 667-3511 to 12 </p>
  </div>
  <div style="clear:both;"></div>
</div>
</body>
</html>
