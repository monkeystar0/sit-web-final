<div>
<div class="fadebg">
    <video autoplay loop muted>
        <source src="/video/qt.mp4" type="video/mp4">
    </video> 

</div>
<div class="welcome">
    <div class="welcome-header">
        <h1>Welcome to Queenstown tourist information center</h1>
    </div>
</div>

<div class="weather-box">
    <h2>weather<br>API response display {{json_encode($testgg, JSON_PRETTY_PRINT)}}</h2>
</div>

<div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Queenstown
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li>About</li>
                    </ul>
                    <ul class="navbar-nav me-auto">
                        <li>Sightseeings</li>
                    </ul>
                    <ul class="navbar-nav me-auto">
                        <li>Activities</li>
                    </ul>
                </div>
            </div>
</nav>
    </div>
</div>

