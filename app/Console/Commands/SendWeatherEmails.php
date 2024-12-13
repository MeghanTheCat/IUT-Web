<?php

namespace App\Console\Commands;

use App\Notifications\WeatherReport;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\WeatherService;
use App\Notifications\SendNotification;

class SendWeatherEmails extends Command
{
    protected $signature = 'weather:send-reports';

    protected $description = 'Sending email to user for daily update on favorite city';

    public function handle()
    {
        $users = User::whereNotNull('favorite_city')->get();
        foreach ($users as $user) {
            $city = $user->favorite;
            if ($city != null) {
                $weatherService = new WeatherService();
                $weatherData = $weatherService->getWeather($city);

                $data = [
                    'weatherData' => $weatherData
                ];
                $user->notify(new SendNotification($data));
                $this->info("Successfully sent to {$user->email}");
            }
        }
    }

    private function getWeather($city)
    {
        $service = new WeatherService;
        $weatherData = $service->getWeeklyForecast($city);
        return $weatherData;
    }
}
