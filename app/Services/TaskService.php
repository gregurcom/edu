<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function get(): Collection
    {
        return Auth::user()->tasks()->orderByRaw('-end_time DESC')->get();
    }
}
