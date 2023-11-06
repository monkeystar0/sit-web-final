<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
.reserve-confirm-main {
  position: relative;
  height: 100vh;
  width: 100%;
  overflow: auto;
}

.reserve-confirm-card{
  width: fit-content;
  padding: 15px;
  height: fit-content;
  border-radius: 25px;
  box-shadow: 2px 15px 5px #ffbc48;
  background-color: whitesmoke;
  position: absolute;
  left: 25%;
  top: 40px;
  box-shadow: 2px 2px 2px #878787;
}



.reserve-header{
  font-size: 50px;
  font-weight: bolder;
  color: #33c719;
}

.reserve-status{
  padding: 5px;
}

.reserve-status.PENDING{
  color: #ffa412;
}

.back-btn {
  display: inline-block;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  color: #2d08ff;
  background-color: #a2e8ff;
  border-radius: 6px;
  outline: none;
  transition: 0.3s;
  width: 50%;
  font-weight: bolder;
  font-family: sans-serif;
  border: 1px solid #0d0d0d;
  transition: color 0.2s;
  box-shadow: 2px 2px 2px #878787;
}

.back-btn:hover{
  background-color: #65d8fe;
}
</style>
</head>
<body>
<div class="reserve-confirm-main">

<div class="reserve-confirm-card">
<div class="row">
    <div class="col-12 text-center reserve-header"><img src="https://www.pngall.com/wp-content/uploads/8/Green-Check-Mark-PNG-Free-Download.png" style="width: 60px; color:green; text-align:center;">  Your booking has been confirmed</div>
    <div class="col-12 text-center">* Please show this email when you arrive at the restaurant or inform the order id to the staff.<br><br></div>
    <div class="col-12 text-center reserve-status"><h3>Customer Information</h3></div>
    <div class="col-2"></div><div class="col-6 text-start reserve-status">Order ID: <b>{{$reservationItem->id}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Date: <b>{{$reservationItem->res_date}} at {{$reservationItem->res_time}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Name: <b>{{$reservationItem->cus_name}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Reserved for <b>{{$reservationItem->no_person}}</b> person(s)</div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Telephone number: <b>{{$reservationItem->tel}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Email: <b>{{$reservationItem->email}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Note: <b>{{$reservationItem->note}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status"><h4>Booked Menu</h4></div>
    <table>
    @foreach ($menuList as $item)
        <tr>
                    @php
                    echo '<td>
                        <p>'.$item['name'].'</p>
</td>';
                    echo '<td>
                        <p>x '.$item['qty'].'</p>
                    </td>';
                    echo '<td>
                        <p><b>'.$item['price'].' $</b></p>
                    </td>';

                    @endphp
        </tr>
@endforeach
    </table>
<div class="col-8"></div><div class="col-4 text-start reserve-status"><b>Total : {{$totalToPay}}$</b><br><br></div>  
</div>
</div>

</div>
</body>
</html>