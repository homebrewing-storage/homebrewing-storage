<?php

declare(strict_types=1);

namespace App\Console;

use App\Notifications\ExpiringIngredients;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule): void
    {
        while(true)
        {
            foreach (User::all() as $user)
            {
                $this->checkUserIngredients($user);
            }
            echo "Done" . PHP_EOL;
            sleep(5);
        }

        $schedule->call(function ()
        {
            //
        })->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    private function checkUserIngredients($user): void
    {
        if($user->userSettings->hop)        $this->checkIngredientType($user->hops);
        if($user->userSettings->yeast)      $this->checkIngredientType($user->yeasts);
        if($user->userSettings->fermentable)$this->checkIngredientType($user->fermentables);
        if($user->userSettings->extra)      $this->checkIngredientType($user->extras);
    }

    private function checkIngredientType($ingredients): void
    {
        foreach ($ingredients as $ingredient)
        {
            $user = User::find($ingredient->user_id);
            $userReminderRange = $user->userSettings->reminder;

            $isExpired = $this->checkIfInExpiringRange($ingredient, $userReminderRange);

            if($isExpired)
            {
                // check user settings to determine whether to send notif and waht chnnel
                $this->notifyUser($user, $ingredient);
            }
        }
    }

    private function checkIfInExpiringRange($ingredient, $userReminderRange): bool
    {
        $expirationDate = $ingredient->expiration_date;
        $today = Carbon::now();

        if(($today < $expirationDate) && ($today->addDays($userReminderRange) >= $expirationDate))
        {
            return true;
        }
        return false;
    }

    private function notifyUser($user, $ingredient)
    {
        $user->notify(
            new ExpiringIngredients($ingredient->name, $ingredient->expiration_date->format('Y-m-d'), $user->userSettings)
        );
    }
}
