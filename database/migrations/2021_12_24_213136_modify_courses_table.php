<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class ModifyCoursesTable extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('image')->default('404.png')->after('description');
        });
    }

    public function down(): void
    {
        Schema::dropColumns('courses', 'image');
    }
}
