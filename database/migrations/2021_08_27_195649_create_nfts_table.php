<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('token_id');
            $table->string('name');
            $table->longText('description');
            $table->integer('price');
            $table->enum('currency', ['Hbar', 'FIL']);
            $table->integer('supply')->default(1);
            $table->string('fil_address')->nullable();
            $table->string('network');
            $table->string('asset');
            $table->string('asset_type');
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
        Schema::dropIfExists('nfts');
    }
}
