<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mail\FacultyChangedProfile;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;

class EmailController extends Controller
{
    /**
     * Send an email to the admin to approve or decline changes made to a faculty member profile.
     *
     * @param  Request $request
     * @return [type]           [description]
     */
    public function sendEmailToAdmin(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->get()->first();

        $department = $request->department;

        // send email
        Mail::to('kuhrt.cowan@ttu.edu')->send(new FacultyChangedProfile($request));

        // Need to figure out how to update database after the admin has verified changes.

        return response($department);
    }
}
