<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ReservationItem;

class ReservationBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $statusDisplay = ["","PENDING","CONFIRMED","CANCELED"];
    public $menuList = [];
    public $totalToPay = 0.0;
    /**
     * Create a new message instance.
     */
    public function __construct(
        public ReservationItem $reservationItem,
    ) {
        $this->menuList = $reservationItem->menuItems;
        $this->totalToPay = collect($this->menuList)->sum('price');

    }

    public function backHome(){
        $this->redirect('/');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        from: new Address('2022007599@student.sit.ac.nz', 'Thai Authentic restuarant'),
        subject: 'Reservation Confirmation',
    );
}

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
