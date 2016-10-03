<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class FacultyChangedProfile extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The request instance.
     *
     * @var Request
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::where('id', '=', Auth::id())->get()->first();

        return $this->view('email')
                    ->with([
                        'first_name'      => $user->first_name,
                        'last_name'       => $user->last_name,
                        'departmentDB'    => $user->department,
                        'phone_numberDB'  => $user->phone_number,
                        'office_numberDB' => $user->office_number,
                        'office_hoursDB'  => $user->office_hours,
                        'researchDB'      => $user->research
                    ]);
    }
}
