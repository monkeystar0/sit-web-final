<div>
    <div class="contact-bg" id="main_div">

        <div class="contact-card">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Contact information</h1><br><br>
                </div>
                <div class="col-4">
                    <h2>Address:</h2>
                </div>
                <div class="col-8">
                    <h3>121 Tay Street, Invercargill 9810</h3>
                </div>
                <div class="col-4">
                    <h2>Telephone number: </h2>
                </div>
                <div class="col-8">
                    <h3>088-7634958</h3>
                </div>
                <div class="col-4">
                    <h2>Email Address: </h2>
                </div>
                <div class="col-8">
                    <h3>2022007599@student.sit.ac.nz</h3>
                </div>
                <div class="col-12">
                    <h3><br>Operating Hours</h3>
                </div>
                <div class="row">
                <div class="col-4">
                    <h4>Monday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                <div class="col-4">
                    <h4>Tuesday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                <div class="col-4">
                    <h4>Wednesday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                <div class="col-4">
                    <h4>Thursday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                <div class="col-4">
                    <h4>Friday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                <div class="col-4">
                    <h4>Saturday</h4>
                </div>
                <div class="col-8">
                    <h4>10:00 - 18:00</h4>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="second-section" id="second-section">
        <div class="welcome">
            <div class="welcome-header" wire:click.prevent="goToHome">
                <h2>Authentic Thai Restuarant</h2>
            </div>
        </div>
        <div class="main-menu">
            <div class="row">
                <div class="col-12 main-menu-item">
                    <h1><a href="javascript;" wire:click.prevent="goToFoodMenu">Menu</a></h1>
                </div>
                <div class="col-12 main-menu-item">
                    <h1><a href="javascript;" wire:click.prevent="contactus">Contact us</a></h1>
                </div>
                <div class="col-12" style="margin-top: 20px;">
                    <a class="book-btn" href="" wire:click.prevent="reserve">Book Online Now!</a>
                </div>
            </div>
        </div>
        <div class="res-status">
            <div class="row">
                <div class="col-8" style="text-align:end;">
                    <h2>Operating status:</h2>
                </div>
                <div class="col-4">
                    <h2 class="{{$res_status_css}}" x-text="$wire.res_status_text"></h2>
                </div>
            </div>
        </div>
    </div>
</div>