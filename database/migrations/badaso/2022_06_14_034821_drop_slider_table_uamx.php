<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSliderTableUamx extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::dropIfExists('slider');

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
        Schema::create('slider', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
			$table->string('name', 255);
			$table->string('image', 255);
			$table->string('link', 255);
			$table->timestamps();
        });
    }
}
