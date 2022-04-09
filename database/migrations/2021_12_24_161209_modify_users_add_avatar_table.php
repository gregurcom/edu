<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class ModifyUsersAddAvatarTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('avatar.png')->after('email');
        });
    }

    public function down(): void
    {
        Schema::dropColumns('users', 'avatar');
    }
}
