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

    private function checkUserIngredients($user)
    {
        $this->checkIngredientType($user->hops);
        $this->checkIngredientType($user->yeasts);
        $this->checkIngredientType($user->fermentables);
        $this->checkIngredientType($user->extras);
    }

    private function checkIngredientType($ingredients)
    {
        foreach ($ingredients as $ingredient)
        {
            $isExpired = $this->checkIfInExpiringRange($ingredient);

            if($isExpired) User::find($ingredient->user_id)->notify(
                new ExpiringIngredients($ingredient->name, $ingredient->expiration_date->format('Y-m-d'))
            );
        }
    }

    private function checkIfInExpiringRange($ingredient): bool
    {
        $expirationDate = $ingredient->expiration_date;
        $today = Carbon::now();

        if(($today < $expirationDate) && ($today->addDays(7) >= $expirationDate))
        {
            return true;
        }
        return false;
    }

}
