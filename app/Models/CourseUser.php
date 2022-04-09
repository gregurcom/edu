<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CourseUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseUser whereUserId($value)
 * @mixin \Eloquent
 */
final class CourseUser extends Model
{
    use HasFactory;

    protected $table = 'course_user';
    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
