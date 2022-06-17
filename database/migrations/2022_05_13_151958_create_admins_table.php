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
        Schema::create('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('user_role_id');
            $table->integer('ticket_closed')->nullable();
            $table->timestamps();

            $table->primary('user_id');

            // $table->foreign('user_role_id')->references('user_role_id')->on('users');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
