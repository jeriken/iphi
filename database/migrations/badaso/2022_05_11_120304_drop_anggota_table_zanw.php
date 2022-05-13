<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAnggotaTableZanw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::dropIfExists('anggota');

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
        Schema::create('anggota', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
			$table->string('email', 255);
			$table->string('password', 255);
			$table->string('nama', 255);
			$table->text('alamat');
			$table->string('foto', 255);
			$table->tinyInteger('role');
			$table->timestamps();
        });
    }
}
