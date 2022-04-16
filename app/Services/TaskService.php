<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class TaskService
{
    public function get(): Collection|null
    {
        return Auth::user()->tasks()->orderByRaw('-end_time DESC')->get();
    }
}
