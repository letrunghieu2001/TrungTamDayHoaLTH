<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_announcements', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            
            $table->foreignID('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignID('class_id')->constrained('classes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_announcements');
    }
};
