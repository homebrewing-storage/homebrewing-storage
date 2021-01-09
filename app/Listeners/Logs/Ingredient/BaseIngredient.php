<?php

declare(strict_types=1);

namespace App\Listeners\Logs\Ingredient;

use App\Events\Ingredient\BaseIngredientEvent;
use App\Listeners\Logs\BaseLog;

abstract class BaseIngredient extends BaseLog
{
    public function handle(BaseIngredientEvent $event): void
    {
        $name = $event->ingredient;
        $type = $event->type;
        $this->logger->channel('database')->info($this->message,
            [
                "Ingredient",
                $type,
                $name,
                "Success"
            ]
        );
    }
}
