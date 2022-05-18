<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropKasTableRolf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::dropIfExists('kas');

        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
			$table->string('judul', 255);
			$table->bigInteger('jumlah');
			$table->timestamp('tanggal')->default('as_defined');
			$table->timestamps();
        });
    }
}
