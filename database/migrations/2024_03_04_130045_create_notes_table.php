<?php

use App\Models\User;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('image_url')->nullable();
            $table->foreignIdFor(User::class, 'user_id');
            $table->tinyInteger('type_id')->default(\NoteType::Text->value);
            $table->string('url')->nullable();
            $table->string('metadata_title')->nullable();
            $table->string('metadata_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
