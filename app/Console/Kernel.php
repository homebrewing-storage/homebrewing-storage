<?php

declare(strict_types=1);

namespace App\Console;

use App\Models\Ingredient;
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
        $users = new User();
        $users = $users->all();
        while (true) {
            foreach ($users as $user) {
                $this->checkUserIngredients($user);
            }
            echo "Done" . PHP_EOL;
            sleep(5);
        }

//        $schedule->call(function () {
//            //
//        })->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    private function checkUserIngredients(User $user): void
    {
        if ($user->userSettings->hop) $this->checkIngredientType($user->hops);
        if ($user->userSettings->yeast) $this->checkIngredientType($user->yeasts);
        if ($user->userSettings->fermentable) $this->checkIngredientType($user->fermentables);
        if ($user->userSettings->extra) $this->checkIngredientType($user->extras);
    }

    private function checkIngredientType($ingredients): void
    {
        foreach ($ingredients as $ingredient) {
            $user = $ingredient->user;
            $userReminderRange = $user->userSettings->reminder;

            $isExpired = $this->checkIfInExpiringRange($ingredient, $userReminderRange);

            if ($isExpired) {
                $this->notifyUser($user, $ingredient);
            }
        }
    }

    private function checkIfInExpiringRange(Ingredient $ingredient, int $userReminderRange): bool
    {
        $expirationDate = $ingredient->expiration_date;
        $today = new Carbon();

        if (($today < $expirationDate) && ($today->addDays($userReminderRange) >= $expirationDate)) {
            return true;
        }
        return false;
    }

    private function notifyUser(User $user, Ingredient $ingredient): void
    {
        $user->notify(
            new ExpiringIngredients($ingredient->name, $ingredient->expiration_date->format('Y-m-d'), $user->userSettings)
        );
    }
}
