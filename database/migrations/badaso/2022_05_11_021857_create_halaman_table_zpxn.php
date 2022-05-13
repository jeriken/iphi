<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHalamanTableZpxn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

                    Schema::create('halaman', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
			$table->string('judul', 255);
			$table->longText('konten');
			$table->string('slug', 255)->unique('slug');
			$table->string('status', 255);
			$table->bigInteger('users_id')->unsigned();
			$table->timestamps();
        });

        Schema::table('halaman', function (Blueprint $table) {
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
        Schema::dropIfExists('halaman');
    }
}
