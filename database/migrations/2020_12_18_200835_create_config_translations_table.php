<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('config_id');
            $table->string('locale')->index();

            $table->string('config_name');
            $table->text('config_value');

            $table->unique(['config_id', 'locale']);

            $table->foreign('config_id')
                ->references('id')
                ->on('configs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('config_translations');
    }
}
