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
        Schema::create('class_calendars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignID('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignID('calendar_id')->constrained('calendars')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_calendars');
    }
};
