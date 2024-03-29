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
        Schema::table('report_comments', function (Blueprint $table) {
            $table->foreignID('user_created_id')->constrained('users')->cascadeOnDelete();
            $table->foreignID('user_comment_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_comments', function (Blueprint $table) {
            $table->foreignID('user_created_id')->constrained('users')->cascadeOnDelete();
            $table->foreignID('user_comment_id')->constrained('users')->cascadeOnDelete();
        });
    }
};
