<div class="reserve-confirm-main">

<div class="reserve-confirm-card">
<div class="row">
    <div class="col-12 text-center reserve-header"><img src="{{ asset('/images/green-checked.png') }}" style="width: 60px;">Your booking has been successfully processed</div>
    <div class="col-12 text-center">*You will receive a confirmation email once our team confirm your request booking. Additionally, the confirmation process usually take 10 - 45 minutes.<br><br></div>
    <div class="col-12 text-center reserve-status"><h3>Customer Information</h3></div>
    <div class="col-2"></div><div class="col-6 text-start reserve-status">Order ID: <b>{{$reservationInfo[0]->id}}</b></div>
    <div class="col-2 reserve-status text-start">Status:</div><div class="col-2 text-start reserve-status {{$statusDisplay[$reservationInfo[0]->status]}}"><b>{{$statusDisplay[$reservationInfo[0]->status]}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Date: <b>{{$reservationInfo[0]->res_date}} at {{$reservationInfo[0]->res_time}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Name: <b>{{$reservationInfo[0]->cus_name}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Reserved for <b>{{$reservationInfo[0]->no_person}}</b> person(s)</div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Telephone number: <b>{{$reservationInfo[0]->tel}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Email: <b>{{$reservationInfo[0]->email}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status">Note: <b>{{$reservationInfo[0]->note}}</b></div>
    <div class="col-2"></div><div class="col-10 text-start reserve-status"><h4>Booked Menu</h4></div>
    @foreach ($menuList as $item)
                <div class="row">
                <div class="col-2"></div>
                    @php
                    echo '<div class="col-5">
                        <p>'.$item['name'].'</p>
                    </div>';
                    echo '<div class="col-2">
                        <p>x '.$item['qty'].'</p>
                    </div>';
                    echo '<div class="col-3">
                        <p><b>'.$item['price'].' $</b></p>
                    </div>
                </div>';

                    @endphp
@endforeach
<div class="col-8"></div><div class="col-4 text-start reserve-status"><b>Total : {{$totalToPay}}$</b><br><br></div>  
<div class="col-12 text-center"><button class="back-btn" wire:click="backHome" style="height: 100%;">Home</button></br></div> 
</div>
</div>

</div>