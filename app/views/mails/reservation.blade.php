<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Invoice</title>

</head>

<body style="background-color: #333;font-family: Arial, Helvetica, sans-serif;font-size: 14px;color: #333;line-height: 14px;">
<div id="invoice" style="background-color: #FFF;margin: auto;width: 800px;min-height: 800px; padding:25px;">
  <h1>Reservation Information</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;">
  <tr>
    <td width="31%">Model Number</td>
    <td width="69%">{{ $property->model_number }}</td>
  </tr>
  <tr>
    <td>Model Name</td>
    <td>{{ $property->name }}</td>
  </tr>
  <tr>
    <td>Client Name</td>
    <td>{{ $firstname }} {{ $lastname }}</td>
  </tr>
  <tr>
    <td>Landline</td>
    <td>{{ $phone }}</td>
  </tr>
  <tr>
    <td>Mobile</td>
    <td>{{ $mobile }}</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>{{ $email }}</td>
  </tr>
  <tr>
    <td>Home Address</td>
    <td>{{ $home_address }}</td>
  </tr>
  <tr>
    <td>Work Address</td>
    <td>{{ $work_address }}</td>
  </tr>
  <tr>
    <td>TIN Number</td>
    <td>{{ $tin_number }}</td>
  </tr>
  <tr>
    <td>Company</td>
    <td>{{ $firstname }}</td>
  </tr>
  <tr>
    <td>Nature of Work</td>
    <td>{{ $company }}</td>
  </tr>
  <tr>
    <td>Terms</td>
    <td>{{ $terms }}</td>
  </tr>
  <tr>
    <td>Unit Type</td>
    <td>{{ $unit_type }}</td>
  </tr>
</table>
  <div style="clear:both;"></div>
</div>
</body>
</html>
