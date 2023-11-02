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
                        <ul class="days" id="calendarDays">Loading.....</ul>
                    </div>
                </div>
                <div id="myDiv"></div>
                <br>Note: Our operation hours are Tuesday to Saturday (10:00 - 18:00)
            </div>
            <div class="col-5">
                <h2>Information</h2>
                <form wire:submit="submitReservation">
                    <div class="row">
                        <div class="col-4 customer-info-input">
                            Date:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" class="form-control" disabled id="dateDisplay">
                            @error('selectedDate') <span class="error">This field is required.</span> @enderror
                            <input type="text" wire:model="selectedDate" id="selectedDate" value="" hidden>
                        </div>
                        <div class="col-4 customer-info-input">
                            Time:
                        </div>
                        <div class="col-8 customer-info-input">
                            <select class="form-control" wire:model.live="selectedTime">
                                <option value="">select time</option>
                                @foreach ($available_time_slots as $time_slot)
                                <option value="{{$time_slot}}">{{$time_slot}}</option>
                                @endforeach
                            </select>
                            <div>
                                @error('selectedTime') <span class="error">This field is required.</span> @enderror
                            </div>
                            <div x-text="$wire.availableSeat"></div>
                        </div>
                        <div class="col-4 customer-info-input">
                            Name:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" name="reserveName" wire:model.live="reserveName" class="form-control">
                            <div>
                                @error('reserveName') <span class="error">This field is required.</span> @enderror
                            </div>
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
                            @error('customerTel') <span class="error">This field is required.</span> @enderror
                        </div>
                        <div class="col-4 customer-info-input">
                            Email Address:
                        </div>
                        <div class="col-8 customer-info-input">
                            <input type="text" class="form-control" wire:model.live="customerEmail">
                            @error('customerEmail') <span class="error">This field is required.</span> @enderror
                        </div>
                        <div class="col-4 customer-info-input">
                            Choosen Menu:
                        </div>
                        <div class="col-8 customer-info-input">
                            0
                            <a href="#menu-selecting">>>Choose menu<<</a>
                        </div>
                        <div class="col-4 customer-info-input">
                            Note:
                        </div>
                        <div class="col-8 customer-info-input">
                            <textarea class="form-control" rows="5" cols="33" placeholder="please specify if you have any special request"></textarea>
                        </div>
                        <div class="col-6 customer-info-input">
                            <button class="book-btn" type="submit">Book</button></br>
                        </div>
                        <!-- <div class="col-12"><br></div> -->
                        <div class="col-6 customer-info-input">
                            <a class="book-btn" href="#" wire:click.prevent="goBack">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="menu-selecting" id="menu-selecting">
    <img src="{{ asset('/images/menu-main-bg.jpeg') }}" class="menu-main-bg">
    <div class="menuPanel hide-menu" id="menuPanel" wire:ignore>
        <div class="menu-list-content">
            <div class="row">
                <div class="col-12 customer-info-input">
                    <h3>Customer Information</h3>
                </div>
                <div class="col-4 customer-info-input">
                    Name:
                </div>
                <div class="col-8 customer-info-input">
                    <div x-text="$wire.reserveName"></div>
                </div>
                <div class="col-4 customer-info-input">
                    Date:
                </div>
                <div class="col-8 customer-info-input">
                    <h2 x-text="$wire.selectedDate"></h2> at <h2 x-text="$wire.selectedTime"></h2>
                </div>
            </div>

        </div>
    </div>
    <div class="container menu-main-container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-12 text-center"><h1>Thai Authentic food menu</h1></div>
            <div class="col-12"><h3>Entree, Lunch/Dinner, Desserts, Drinks</h3></div>
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="https://ucarecdn.com/377cfc3d-ad21-4b57-8449-40aeaf96af67/-/resize/x400/-/format/auto/-/progressive/yes/1-2.jpg">
                    <div class="menu-name">
                        Fired rice
                    </div>
                    <div class="menu-price">
                        15.5$
                    </div>
                    <div class="menu-detail">
                        rice tomato
                    </div>
                    <button class="add-btn">Add</button>
                </div>
            </div>
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="https://www.newzealand.com/assets/Tourism-NZ/Other/1a073e6576/img-1536111724-1882-20357-p-460BE22E-DA4C-C55B-27544EB062B49C2B-2544003__aWxvdmVrZWxseQo_FocalPointCropWzQzMCwzMDAsNTAsNTAsNzUsInBuZyIsNjUsMi41XQ.png">
                    <div class="menu-name">
                        Fired rice
                    </div>
                    <div class="menu-price">
                        15.5$
                    </div>
                    <div class="menu-detail">
                        rice tomato
                    </div>
                    <button>Add</button>
                </div>
            </div>
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="https://www.newzealand.com/assets/Tourism-NZ/Other/1a073e6576/img-1536111724-1882-20357-p-460BE22E-DA4C-C55B-27544EB062B49C2B-2544003__aWxvdmVrZWxseQo_FocalPointCropWzQzMCwzMDAsNTAsNTAsNzUsInBuZyIsNjUsMi41XQ.png">
                    <div class="menu-name">
                        Fired rice
                    </div>
                    <div class="menu-price">
                        15.5$
                    </div>
                    <div class="menu-detail">
                        rice tomato
                    </div>
                    <button>Add</button>
                </div>
            </div>
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="https://www.newzealand.com/assets/Tourism-NZ/Other/1a073e6576/img-1536111724-1882-20357-p-460BE22E-DA4C-C55B-27544EB062B49C2B-2544003__aWxvdmVrZWxseQo_FocalPointCropWzQzMCwzMDAsNTAsNTAsNzUsInBuZyIsNjUsMi41XQ.png">
                    <div class="menu-name">
                        Fired rice
                    </div>
                    <div class="menu-price">
                        15.5$
                    </div>
                    <div class="menu-detail">
                        rice tomato
                    </div>
                    <button>Add</button>
                </div>
            </div>
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="https://www.newzealand.com/assets/Tourism-NZ/Other/1a073e6576/img-1536111724-1882-20357-p-460BE22E-DA4C-C55B-27544EB062B49C2B-2544003__aWxvdmVrZWxseQo_FocalPointCropWzQzMCwzMDAsNTAsNTAsNzUsInBuZyIsNjUsMi41XQ.png">
                    <div class="menu-name">
                        Fired rice
                    </div>
                    <div class="menu-price">
                        15.5$
                    </div>
                    <div class="menu-detail">
                        rice tomato
                    </div>
                    <button>Add</button>
                </div>
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