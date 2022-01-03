<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('telephone');
            $table->timestamps();
        });

        DB::table('toko')->insert(
            array(
                'name' => 'toko admin',
                'address' => 'Jl. Jendral Sudirman, Sungai Pakning 28761',
                'telephone' => '082116888870',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toko');
    }
}
