<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->engine = 'InnoDB';
            if ( ! Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique();
            }
            if ( ! Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
    }
}
