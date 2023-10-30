<div class="main-reserve">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <div class="reserve-header">
        <h1>Reservation Online</h1>
    </div>
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-7">
                <h2>Please select the date <br></h2>
                <div class="wrapper" wire:ignore>
                    <header>
                        <p class="current-date"></p>
                        <div class="icons">
                            <span id="prev" class="material-symbols-rounded">chevron_left</span>
                            <span id="next" class="material-symbols-rounded">chevron_right</span>
                        </div>
                    </header>
                    <div class="calendar">
                        <ul class="weeks">
                            <li>Sun</li>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                        </ul>
                        <ul class="days" id="calendarDays">testtttttttttttttttttt</ul>
                    </div>
                </div>
                <div id="myDiv"></div>
                <br>Note: Our operation hours are Tuesday to Saturday (10:00 - 18:00)
            </div>
            <div class="col-5">
                <h2>Information</h2>
                <form wire:submit="save">
                    <div class="row">
                        <div class="col-4 customer-info-input">
                            Date:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" class="form-control" disabled id="dateDisplay">
                            <input type="text" wire:model="selectedDate" id="selectedDate" value="" hidden>
                        </div>
                        <div class="col-4 customer-info-input">
                            Time:
                        </div>
                        <div class="col-8 customer-info-input">
                            <select  class="form-control" wire:model.live="selectedTime">
                                <option value="">select time</option>
                                @foreach ($available_time_slots as $time_slot)
                                <option value="{{$time_slot}}">{{$time_slot}}</option>
                                @endforeach
                            </select>
                            <div x-text="$wire.availableSeat"></div>
                        </div>
                        <div class="col-4 customer-info-input">
                            Name:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" name="reserveName" wire:model.live="reserveName" class="form-control">
                        </div>
                        <div class="col-4 customer-info-input">
                            Numer of Person:
                        </div>
                        <div class="col-8 customer-info-input">
                            <select name="numberOfPerson" id="numberOfPerson" class="form-control">
                                @foreach ($no_persons as $val)
                                <option value="{{$val}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 customer-info-input">
                            Telephone Number:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="tel" wire:model.live="customerTel" class="form-control">
                        </div>
                        <div class="col-4 customer-info-input">
                            Email Address:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-4 customer-info-input">
                            Note:
                        </div>
                        <div class="col-8 customer-info-input">
                            <textarea  class="form-control" rows="5" cols="33" placeholder="please specify if you have any special request"></textarea>
                        </div>
                        <div class="col-12 customer-info-input">
                            <button class="book-btn" type="submit">Book</button></br>
                        </div>
                        <div class="col-12"><br></div>
                        <div class="col-12">
                            <a class="book-btn" href="#" wire:click.prevent="reserve">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    document.addEventListener('livewire:initialized', () => {
    console.log("ttt");
    //renderCalendar();
    Livewire.on('searchTermUpdated', (event) => {
        console.log(event);
        $wire.selectedDate = event;
        // setTimeout(function() {  
        //     console.log(selectedDate);
        //     //renderCalendar();
        // }, 3);
    });
});
</script> -->