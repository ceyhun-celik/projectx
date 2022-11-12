<?php

use App\Enums\Authorizations\Languages;
use App\Enums\Authorizations\Statuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authorizations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('role_code');
            $table->enum('status', array_column(Statuses::cases(), 'value'))->default(Statuses::ACTIVE->value);
            $table->enum('language', array_column(Languages::cases(), 'value'))->default(Languages::TURKISH->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorizations');
    }
};
