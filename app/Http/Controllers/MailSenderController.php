<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\ReservationBooked;
use App\Models\ReservationItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;

class MailSenderController extends Controller
{
    /**
     * Ship the given order.
     */
    public function sendMail($id)
    {
        $order = ReservationItem::findOrFail($id);
 
        // Ship the order...
        $user = new stdClass;
        $user->name = $order->cus_name;
        $user->email = $order->email;
        Mail::to($user)->send(new ReservationBooked($order));
 
       // return redirect('/orders');
    }
}