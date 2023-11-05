<div class="management-container">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Thai Authentic restuarant') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container management-main">
        <div class="row">
            <div class="col-12">
                <h3>Pending Tasks</h3>
            </div>
        </div>

        <div class="card-container">
            @foreach ($reservations_pending as $task)
            <div class="card">
                <div class="card-header pending"><b>{{$task->res_date}} at {{$task->res_time}}</b></div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{$task->cus_name}}</h4>
                        </div>
                        <div class="col-10 text-start reserve-status">Reserved for <b>{{$task->no_person}}</b> person(s)</div>
                        <div class="col-12 text-start reserve-status">Telephone number: <b>{{$task->tel}}</b></div>
                        <div class="col-12 text-start reserve-status">Email: <b>{{$task->email}}</b></div>
                        <div class="col-12 text-start reserve-status">Note: <b>{{$task->note}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-4  btn-action"><button type="button" onClick='onConfirmAction({{$task->id}})' class="btn btn-success">
                                Confirm
                            </button></div>
                        <div class="col-4  btn-action"><button type="button" onClick="onCancelAction({{$task->id}})" class="btn btn-danger">
                                Cancel
                            </button></div>
                        <div class="col-4  btn-action"><button type="button" class="btn btn-primary" onClick="onClickMenuDetail({{$task->id}})" data-toggle="modal" data-target="#exampleModalLong">
                                Menu
                            </button></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <h3><br>Confirmed Tasks</h3>
            </div>
        </div>
        <div class="card-container">
            @foreach ($reservations_confirmed as $task)
            <div class="card">
                <div class="card-header confirmed"><b>{{$task->res_date}} at {{$task->res_time}}</b></div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{$task->cus_name}}</h4>
                        </div>
                        <div class="col-10 text-start reserve-status">Reserved for <b>{{$task->no_person}}</b> person(s)</div>
                        <div class="col-12 text-start reserve-status">Telephone number: <b>{{$task->tel}}</b></div>
                        <div class="col-12 text-start reserve-status">Email: <b>{{$task->email}}</b></div>
                        <div class="col-12 text-start reserve-status">Note: <b>{{$task->note}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-4  btn-action"><button type="button" onClick="onCancelAction({{$task->id}})" class="btn btn-danger">
                                Cancel
                            </button></div>
                        <div class="col-4  btn-action"><button type="button" class="btn btn-primary" onClick="onClickMenuDetail({{$task->id}})" data-toggle="modal" data-target="#exampleModalLong">
                                Menu
                            </button></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <h3><br>Cancelled Tasks</h3>
            </div>
        </div>
        <div class="card-container">
            @foreach ($reservations_cancelled as $task)
            <div class="card">
                <div class="card-header cencelled"><b>{{$task->res_date}} at {{$task->res_time}}</b></div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{$task->cus_name}}</h4>
                        </div>
                        <div class="col-10 text-start reserve-status">Reserved for <b>{{$task->no_person}}</b> person(s)</div>
                        <div class="col-12 text-start reserve-status">Telephone number: <b>{{$task->tel}}</b></div>
                        <div class="col-12 text-start reserve-status">Email: <b>{{$task->email}}</b></div>
                        <div class="col-12 text-start reserve-status">Note: <b>{{$task->note}}</b></div>
                    </div>
                    <div class="row">
                        <div class="col-4  btn-action"><button type="button" class="btn btn-primary" onClick="onClickMenuDetail({{$task->id}})" data-toggle="modal" data-target="#exampleModalLong">
                                Menu
                            </button></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Menu Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function onClickMenuDetail(id){
        @this.dispatch('menuClick', {
                id: id
            });
    }

    function togglePopup(button) {
        var popup = button.nextElementSibling;
        if (popup.style.display == 'block') {
            popup.style.display = 'none'; // Hide the popup
        } else {
            popup.style.display = 'block'; // Show the popup
        }
    }

    function onConfirmAction(id) {
        if (confirm('Are you sure you want to confirm this?')) {
            @this.dispatch('confirmReserve', {
                id: id
            });
        }
    }

    function onCancelAction(id) {
        if (confirm('Are you sure you want to cancel this?')) {
            @this.dispatch('cancelReserve', {
                id: id
            });
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>