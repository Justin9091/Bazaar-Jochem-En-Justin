<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentTable extends Migration
{
    public function up()
    {
        Schema::create('rent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisment_id')->constrained()->onDelete('cascade');
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rent');
    }
}
