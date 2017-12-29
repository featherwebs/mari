<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostTypesAddCustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_types', function (Blueprint $table) {
            $table->text('custom')->nullable()->after('slug');
            $table->text('alias')->nullable()->after('custom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_types', function (Blueprint $table) {
            //
        });
    }
}
