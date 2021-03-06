<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('name', 100);
            $table->string('english_name', 100);
            $table->string('alphabetic_code', 10);
            $table->string('didgit_code', 10);
            $table->double('rate');
        });
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
