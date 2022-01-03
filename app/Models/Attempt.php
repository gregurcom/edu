<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attempt
 *
 * @property int $id
 * @property string $email
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attempt whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attempt extends Model
{
    use HasFactory;

    protected $guarded = [];
}
