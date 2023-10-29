<div class="main-reserve">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <div class="reserve-header">
        <h1>Reservation Online</h1>
    </div>
    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-7">
                <h2>Please select the date <br></h2>
                <div class="wrapper">
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
                        <ul class="days"></ul>
                    </div>
                </div>
                <br>Note: Our operation hours are Tuesday to Saturday (10:00 - 18:00)
            </div>
            <div class="col-5">
                <h2>Information</h2>
                <form wire:submit="save">
                    <div class="row">
                        <div class="col-4">
                            Date:
                        </div>
                        <div class="col-8">
                            <input type="text" disabled id="dateDisplay">
                            <input type="text" wire:model="selectedDate" id="selectedDate" value="" hidden>
                        </div>
                        <div class="col-4">
                            Time:
                        </div>
                        <div class="col-8">
                            <select wire:model="selectedTime">
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                            </select>
                            <div x-text="$wire.selectedTime"></div>
                        </div>
                        <div class="col-4">
                            Name:
                        </div>
                        <div class="col-8">
                            <input type="text" name="reserveName" wire:model="reserveName">
                        </div>
                        <div class="col-4">
                            Numer of Person:
                        </div>
                        <div class="col-8">
                            <select name="numberOfPerson" id="numberOfPerson">
                                @foreach ($no_persons as $val)
                                <option value="{{$val}}">{{$val}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            Telephone Number:
                        </div>
                        <div class="col-8">
                            <input type="tel" wire:model="customerTel">
                            <div x-text="$wire.reserveName"></div>
                        </div>
                        <div class="col-4">
                            Email Address:
                        </div>
                        <div class="col-8">
                            <input type="text">
                        </div>
                        <div class="col-4">
                            Note:
                        </div>
                        <div class="col-8">
                            <textarea rows="5" cols="33" placeholder="please specify if you have any special request"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit">Book</button>
                        </div>
                        <div class="col-12">
                            <a class="book-btn" href="#" wire:click.prevent="reserve">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>