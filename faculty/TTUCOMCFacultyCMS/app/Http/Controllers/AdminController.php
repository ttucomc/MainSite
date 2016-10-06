<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;
use Session;

class AdminController extends Controller
{
    public function createFaculty(Request $request)
    {
        // validate form data

        $user = new User;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->office_hours = $request->office_hours;
        $user->office_number = $request->office_number;
        $user->image_path = 'test.jpeg';
        $user->department = $request->department;
        $user->title = $request->title;
        $user->research = $request->research;
        $user->password = bcrypt('secret');
        $user->remember_token = str_random(10);
        $user->made_changes = 0;

        $user->save();
    }

    /**
     * [approveChanges description]
     *
     * @return [type] [description]
     */
    public function approveChanges($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $user->made_changes = 0;
        $user->save();

        $formData = session('user-' . $user->id . '-form-data');
        $formData = collect($formData);

        // Update database
        DB::table('users')->where('id', $user->id)
                          ->update([
                            'phone_number'  => $formData->get('phone_number'),
                            'office_number' => $formData->get('office_number'),
                            'office_hours'  => $formData->get('office_hours'),
                            'department'    => $formData->get('department'),
                            'research'      => $formData->get('research')
                          ]);

        // Delete session
        session::forget('user-' . $user->id . '-form-data');

        return view('/admin-changes-confirmation');
    }
}
