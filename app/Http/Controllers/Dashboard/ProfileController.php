<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        return view('dashboard.profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'country' => 'required|string|size:2',
            'street_address' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $user->profile->fill($request->all())->save();
        // $profile = $user->profile;
        // if ($profile->exists) {
        //     $profile->update($request->all());
        // }else{
        //         // $request->merge(['user_id' => $user->id]);
        //         // $profile = Profile::create($request->all());
        //     $profile = $user->profile()->create($request->all());
        //     // $user->profile()->save($profile);
        // }
        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated successfully');
    }
}
