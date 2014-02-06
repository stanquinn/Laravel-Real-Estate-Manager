<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Invoice</title>

</head>

<body style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;color: #333;line-height: 14px;">
<div id="invoice" style="background-color: #FFF;margin: auto;width: 750px;min-height: 800px;">
  <div id="invoice-inner" style="padding: 10px;">
        <table style="none;border-collapse: collapse;padding: 10px;width: 100%;">
        <tr>
        <td style="none;border-collapse: collapse;padding: 10px; width:50%;">
        <p style="line-height: 24px;">Unit 736 Cityland Mega Plaza, ADB Ave.<br>Ortigas, Pasig City<br>Telephone: 667-3511  to 12</p>
        </td>
        <td style="none; border-collapse: collapse;padding: 10px;text-align:right;">
        <img src="{{ URL::to('logo.png') }}">
        </td>
        </tr>
        </table>
      <div style="clear:both;"></div>
    <div style="background-color: #000; line-height:30px; font-size: 24px;display: block;text-align: center;color: #FFF;text-transform: uppercase;margin-bottom: 25px;">RESERVATION INFORMATION</div>
        <table style="none;border-collapse: collapse;padding: 10px;width: 100%;">
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Client Name:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ ucwords($reservation->user->first_name) }} {{ ucwords($reservation->user->last_name) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Tin Number:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->tin_number }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Landline:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->landline }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Mobile:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->mobile }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Work Address:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->work_address }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Home Address:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->home_address }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Company:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->company }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Occupation:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->user->occupation }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Model Number:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->model_number }}</td>
            </tr>
        </table>
        <br />
    <div style="background-color:#000; line-height:30px; font-size: 24px;display: block;text-align: center;color: #FFF;text-transform: uppercase;margin-bottom: 10px;">PROPERTY INFORMATION</div>
    
            <table style="none;border-collapse: collapse;padding: 10px;width: 100%;">
            <tr>
            <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Agent:</td>
            <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ ucwords($reservation->agent->first_name) }} {{ ucwords($reservation->agent->last_name) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Model Number:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->model_number }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Model Name:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ ucwords($property->name) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Beds:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->beds }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Baths:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->baths }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Floor Area:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->floor_area }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Lot Area:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->lot_area }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Reservation Fee:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $property->reservation_fee }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Total Contract Price:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">Php{{ number_format($property->price,2) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Reservation Fee:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">Php{{ number_format($property->reservation_fee,2) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Downpayment:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">Php{{ number_format($reservation->downpayment,2) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Equity:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">Php{{ number_format($reservation->equity,2) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Total Months:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ $reservation->total_months }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Monthly Fee:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">Php{{ number_format($reservation->monthly_fee,2) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:none; color:#000; font-weight:bold;">Unit Type:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ ucwords($reservation->unit_type) }}</td>
            </tr>
            <tr>
                <td width="17%" style="none;border-collapse: collapse;padding: 5px; width:50%; background-color:#fff; color:#000; font-weight:bold;">Terms:</td>
                <td width="83%" style="none;border-collapse: collapse;padding: 5px;">{{ ucwords($reservation->terms) }}</td>
            </tr>
        </table>
    
      <div style="clear:both;"></div>
      <div id="invoice-table"></div>
  </div>
  <div style="clear:both;"></div>
</div>
</body>
</html>
