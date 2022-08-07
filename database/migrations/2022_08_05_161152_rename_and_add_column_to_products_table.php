<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('name', 'name_pl');
            $table->string('name_en')->nullable();;
            $table->renameColumn('description', 'description_pl');
            $table->text('description_en')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('description_pl', 'description');
            $table->renameColumn('name_pl', 'name');
            $table->dropColumn('name_en');
            $table->dropColumn('description_en');
        });
    }
};
