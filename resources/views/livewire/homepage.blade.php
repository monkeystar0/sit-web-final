<div>
    <div class="fadebg" id="main_div">
        <div class="video-content">
            <video autoplay loop muted>
                <source src="{{ asset('/video/th_food_bg.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="second-section" id="second-section">
        <div class="welcome">
            <div class="welcome-header">
                <h2>Authentic Thai Restuarant</h2>
            </div>
        </div>
        <div class="main-menu">
        <div class="row">
        <div class="col-12">
            <h2>Menu</h2>
        </div>
        <div class="col-12">
            <h2>Contact us</h2>
        </div>
            <div class="col-12">
                <a class="book-btn" href="#" wire:click.prevent="reserve">Book Online Now!</a>
            </div>
        </div>
        </div>
        <div class="res-status">
            <div class="row">
                <div class="col-8" style="text-align:end;"><h2>Operating status:</h2></div>
                <div class="col-4"><h2 class="{{$res_status_css}}" x-text="$wire.res_status_text"></h2></div>
            </div>
        </div>
    </div>
</div>