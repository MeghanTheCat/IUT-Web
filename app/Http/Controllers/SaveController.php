<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\UserCity;

class SaveController extends Controller
{

    public function saveCity($city)
    {
        UserCity::firstOrCreate(
            ['user_id' => auth()->id(), 'city' => $city, 'notification_enable' => false]
        );
        return redirect()->route("weather");
    }

    public function killCity($id) {
        $query = UserCity::findOrFail($id);
        $query->delete();
        return redirect()->route('weather');
    }
}
