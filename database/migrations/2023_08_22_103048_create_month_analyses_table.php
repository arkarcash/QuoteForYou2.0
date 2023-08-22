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
        Schema::create('month_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('month_id')->constrained('months','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->bigInteger('traffic');
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
        Schema::dropIfExists('month_analyses');
    }
};
