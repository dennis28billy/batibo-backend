<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->string('nama_penerima');
            $table->string('nomor_handphone');
            $table->string('email');
            $table->string('kategori');
            $table->string('provinsi');
            $table->string('kota_kabupaten');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('detail_alamat');
            $table->decimal('latitude');
            $table->decimal('longitude');

            $table->softDeletes();
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
        Schema::dropIfExists('addresses');
    }
}
