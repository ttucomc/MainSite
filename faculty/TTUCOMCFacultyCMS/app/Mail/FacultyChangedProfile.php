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
     * The user instance
     * 
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email')
                    ->with([
                        'id'              => $this->user->id,
                        'first_name'      => $this->user->first_name,
                        'last_name'       => $this->user->last_name,
                        'departmentDB'    => $this->user->department,
                        'phone_numberDB'  => $this->user->phone_number,
                        'office_numberDB' => $this->user->office_number,
                        'office_hoursDB'  => $this->user->office_hours,
                        'researchDB'      => $this->user->research
                    ]);
    }
}
