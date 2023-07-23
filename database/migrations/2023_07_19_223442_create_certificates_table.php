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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('contributor')->nullable();
            $table->string('rising_star')->nullable();
            $table->string('mentor')->nullable();
            $table->string('guru')->nullable();
            $table->string('mystery')->nullable();
            $table->string('creator')->nullable();
            $table->string('specialist')->nullable();
            $table->string('collaborator')->nullable();
            $table->string('authority')->nullable();
            $table->string('legend')->nullable();
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
        Schema::dropIfExists('certificates');
    }
};
