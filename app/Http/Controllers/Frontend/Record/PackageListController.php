<?php

namespace App\Http\Controllers\Frontend\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Frontend\Transaction\ReservationPackageMail;
use App\Models\Record\Package;
use App\Models\Transaction\Reservation;
use App\Models\Record\Room;
use Illuminate\Support\Carbon;
use Log;
use Mail;

class PackageListController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.record.package.index')
                ->withPackages(Package::where("status", 1)->orderBy("name", "asc")->paginate(5));
    }
    
    /**
     * @return \Illuminate\View\View
     */
    public function show(Package $package)
    {
        return view('frontend.record.package.show')
                ->withPackage($package);
    }

    public function reserve(Package $package){
        
        $reservation = new Reservation(); 
        $reservation->reference_number = $this->checkReference($this->generate_string(20));
        return $this->save($package, $reservation);
    }

    public function save($package, $reservation){
        request()->validate([
            
            'reservation_date' => 'required',
            'reservation_time' => 'required', 
        ]); 

        $reservations = Reservation::where("status", 1)->whereDate("reservation_date", request('reservation_date'))->get();
        $rooms = Room::where("status", 1)->get(); 
        $ctr = 0;
        if(count($reservations) > 0){
            foreach($reservations as $res){ 
                $time = Carbon::parse($res->reservation_time);
                $reserveTime = Carbon::parse(request("reservation_time"));
                $time->addMinutes($res->duration);
                $reserveTime->addMinutes($package->duration);
                if($time->gt($reserveTime) && $reserveTime->gt(Carbon::parse($res->reservation_time)))
                    $ctr++;
            }
        }
        if(count($rooms) == $ctr)
            return redirect()->route('frontend.record.service.show', $service)->withFlashWarning("There are some conflicts on your selected time. Please change your selected time.");
        
            
        $reservation->total_amount = $package->price; 
        $reservation->package_id = $package->id;
        $reservation->duration = $package->duration;
        $reservation->reservation_date = request('reservation_date');
        $reservation->reservation_time = request('reservation_time'); 
        $reservation->user_id = auth()->user()->id; 
        $reservation->save();
        
        $user = auth()->user();

        Mail::to($user->email)->send(new ReservationPackageMail($user, $package, $reservation));
        
        return redirect()->route('frontend.transaction.reservation.index')->withFlashSuccess("Reservation Successfully Saved. Please check your email for your notification.<br>REFERENCE NUMBER : <strong>" . $reservation->reference_number. "</strong>");
    }

    function generate_string($strength = 20) {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return strtoupper($random_string);
    }

    public function checkReference($hash){ 

        while( count(Reservation::where("reference_number", $hash)->get()) > 0){
            $newHash = $this->generate_string(40);
            $count = Reservation::where("reference_number", $newHash)->count();
            if($count > 0)
                continue;
            else{
                return $newHash;
                break;
            }
        }

        return $hash;

    }
}
