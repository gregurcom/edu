<?php

declare(strict_types=1);

namespace App\Http\DTO;

use Carbon\Carbon;

final class TaskDto
{
    public string $title;
    public ?string $description;
    public ?Carbon $end_time;
}
