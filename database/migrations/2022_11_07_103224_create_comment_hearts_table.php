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
        Schema::create('comment_hearts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignID('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignID('comment_id')->constrained('comments')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_hearts');
    }
};
