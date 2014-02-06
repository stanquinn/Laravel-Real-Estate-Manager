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
              <p style="line-height: 24px;"><strong>Customer: {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}</strong><br>{{ nl2br($transaction->user->work_address) }}</p>
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
      <p style="line-height: 24px;">
Account Holder : John Dave Decano<br>
Account Holder Address: 144-3 West Bank Floodway Maybunga Pasig City Philippines 1607<br>
Account Holder Telephone: 639469026992<br>
Bank Name: UNION BANK OF THE PHILIPPINES<br>
Bank Branch: Union Bank Plaza Ortigas Pasig City<br>
Bank Address: UnionBank Plaza Bldg., Meralco Ave. corner Onyx St. Ortigas Pasig City Philippines 1605<br>
Bank Telephone: 1-800-1888-2277*<br>
Bank Account Number: 109452024675<br>
Bank Swift Code: 010419995<br>
Currency: Philippine Peso
      </p> 
  </div>
  <div style="clear:both;"></div>
</div>
</body>
</html>
