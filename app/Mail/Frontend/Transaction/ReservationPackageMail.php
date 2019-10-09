<?php

namespace App\Mail\Frontend\Transaction;

use App\Models\Auth\User;
use App\Models\Record\Package;
use App\Models\Transaction\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationPackageMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $package;
    private $reservation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Package $package, Reservation $reservation)
    {
        $this->user = $user;
        $this->package = $package; 
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from([ "address" => "clinic.ortizskin@gmail.com", "name" => "Ortiz Skin Clinic" ])
            ->view('frontend.mail.reservation-package-details')
            ->subject("Welcome to Ortiz Skin Clinic",  ['app_name' => app_name()])
            ->with([
                "user" => $this->user,
                "package" => $this->package,
                "reservation" => $this->reservation,
            ]);
    }
}
