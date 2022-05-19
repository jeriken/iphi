<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasTableDlgh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('kas', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('judul', 255);
			$table->bigInteger('jumlah');
			$table->timestamp('tanggal');
			$table->bigInteger('users_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('kas', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('badaso_users')->onDelete('cascade')->onUpdate('cascade');
        });

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
        Schema::dropIfExists('kas');
    }
}
