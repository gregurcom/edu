<?php

declare(strict_types = 1);

namespace App\Services;

use App\Http\Requests\AccessRequest;
use App\Models\Attempt;
use Illuminate\Database\Eloquent\Collection;

class AttemptService
{
    public function get(AccessRequest $request): Collection
    {
        return Attempt::where('email', $request->email)
            ->where('ip_address', $request->getClientIp())
            ->where('created_at', '>=', now()->subMinutes(config('attempts.timeout')))
            ->get();
    }

    public function exhaustedAttempts(int $attempts, AccessRequest $request): bool
    {
        if ($attempts < config('attempts.failure')) {
            Attempt::create([
                'email' => $request->email,
                'ip_address' => $request->getClientIp(),
            ]);

            return true;
        }

        return false;
    }
}
