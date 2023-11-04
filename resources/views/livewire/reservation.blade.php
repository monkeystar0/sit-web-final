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
                            <select name="numberOfPerson" wire:model="selectedNoPerson" id="numberOfPerson" class="form-control">
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
                            <input type="email" class="form-control" wire:model.live="customerEmail">
                            @error('customerEmail') <span class="error">This field is required.</span> @enderror
                        </div>
                        <div class="col-4 customer-info-input">
                            Chosen Menu:
                        </div>
                        <div class="col-8 customer-info-input">
                            {{$numberOfMenu}} Items
                            <a href="#menu-selecting"> >>Choose menu<< </a>
                            @foreach ($chosenMenuList as $item)
                            <div class="row">
                                @php
                                $display = $item;
                                echo '<div class="col-6">
                                    <p>'.$display['name'].'</p>
                                </div>';
                                echo '<div class="col-2">
                                    <p>x '.$display['qty'].'</p>
                                </div>';
                                echo '<div class="col-3">
                                    <p><b>'.$display['price'].' $</b></p>
                                </div>';

                                @endphp
                                <div class="col-1">
                                    <p><b>[<a href="javascript:;" wire:click="removeChosenMenu({{$display['id']}})">X</a>]</b></p>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12 customer-info-input text-end">
                                <b>Total: {{$totalToPay}} $</b>
                            </div>
                        </div>
                        <div class="col-4 customer-info-input">
                            Note:
                        </div>
                        <div class="col-8 customer-info-input">
                            <textarea class="form-control" rows="5" wire:model="customerNote" cols="33" placeholder="please specify if you have any special request"></textarea>
                        </div>
                        <div class="col-6 customer-info-input">
                            <button class="book-btn" wire:confirm="Do you confirm to proceed?" type="submit">Book</button></br>
                        </div>
                        <div class="col-6 customer-info-input">
                            <a class="book-btn" href="#" wire:click.prevent="goBack" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="menu-selecting" id="menu-selecting">
    <img src="{{ asset('/images/menu-main-bg.jpeg') }}" class="menu-main-bg">
    <div class="menuPanel hide-menu" id="menuPanel" wire:ignore.self>
        <div class="menu-list-content">
            <div class="row">
                <div class="col-12 customer-info-input">
                    <h3>Customer Information</h3>
                </div>
                <div class="col-4 customer-info-input">
                    Name:
                </div>
                <div class="col-8 customer-info-input text-start">
                    <div x-text="$wire.reserveName"></div>
                </div>
                <div class="col-4 customer-info-input">
                    Date:
                </div>
                <div class="col-8 customer-info-input text-start">
                    <p x-text="$wire.customerInfoDate"></p>
                </div>
                <div class="col-12 customer-info-input">
                    <h3>Menu list:</h3>
                </div>
                <div class="chosen-menu-list-scrollable">
                @foreach ($chosenMenuList as $item)
                <div class="row">
                    @php
                    $display = $item;
                    echo '<div class="col-6">
                        <p>'.$display['name'].'</p>
                    </div>';
                    echo '<div class="col-2">
                        <p>x '.$display['qty'].'</p>
                    </div>';
                    echo '<div class="col-3">
                        <p><b>'.$display['price'].' $</b></p>
                    </div>';

                    @endphp
                    <div class="col-1">
                        <p><b><a href="javascript:;" wire:click="removeChosenMenu({{$display['id']}})" style="color:red;">X</a></b></p>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
            
        </div>
        <div class="menuPanel-bottom">
            <div class="row">
                <div class="col-3 customer-info-input">
                <a class="book-btn" href="#calendarDays">Book</a>
                </div>
                <div class="col-3 customer-info-input">
                    <button class="add-btn" wire:click="clearAllChosenMenu" style="height: 100%;">Clear</button></br>
                </div>
                <div class="col-6 customer-info-input text-center">
                    <b>Total: {{$totalToPay}} $</b>
                </div>
            </div>
            </div>
    </div>
    <div class="container menu-main-container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="header-menu-selecting">Thai Authentic food menu</h1>
            </div>
            <div class="col-12 menu-selecting-menu-bg">
                <div class="row menu-selecting-menu text-center">
                    <div class="col-3 menu-selecting-menu-btn" wire:click="setCurrentMenu(1)">Entree</div>
                    <div class="col-3 menu-selecting-menu-btn" wire:click="setCurrentMenu(2)">Lunch/Dinner</div>
                    <div class="col-3 menu-selecting-menu-btn" wire:click="setCurrentMenu(3)">Desserts</div>
                    <div class="col-3 menu-selecting-menu-btn" wire:click="setCurrentMenu(4)">Drinks</div>
                    </h3>
                </div>
            </div>
            @foreach ( $menuList as $item)
            <div class="col-4">
                <div class="menu-card">
                    <img class="menu-image" src="{{$item->image}}">
                    <div class="menu-name">
                        <strong>{{$item->name}}</strong>
                    </div>
                    <div class="menu-price">
                        {{$item->price}}$
                    </div>
                    <div class="menu-detail">
                        <br>{{$item->description}}<br><br>
                    </div>
                    <div class="row">
                    <div class="col-7">
                    <div class="value-button" id="decrease" onclick='decreaseValue({{ $item->id }})' value="Decrease Value">-</div>
                    <input type="number" class="qty-select" id="qty-{{ $item->id }}" value="1" disabled />
                    <div class="value-button" id="increase" onclick="increaseValue({{ $item->id }})" value="Increase Value">+</div></div><div class="col-5"><button onClick="addItem({{ $item->id }})" class="add-btn">Add</button></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function addItem(id) {
        var value = parseInt(document.getElementById('qty-' + id).value, 10);
        window.Livewire.dispatch('add-menu-item', {
            id: id,
            qty: value
        });
        document.getElementById('qty-' + id).value = 1;
    }

    const increaseValue = (id) => {
        var value = parseInt(document.getElementById('qty-' + id).value, 10);
        value = isNaN(value) ? 1 : value;
        value++;
        document.getElementById('qty-' + id).value = value;
    }

    const decreaseValue = (id) => {
        var value = parseInt(document.getElementById('qty-' + id).value, 10);
        value = isNaN(value) ? 0 : value;
        value <= 2 ? value = 2 : '';
        value--;
        document.getElementById('qty-' + id).value = value;
    }
</script>