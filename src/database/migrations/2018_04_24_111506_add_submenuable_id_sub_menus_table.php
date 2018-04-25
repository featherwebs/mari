<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubmenuableIdSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_menus', function (Blueprint $table) {
            $table->dropForeign('sub_menus_menu_id_foreign');
            $table->renameColumn('menu_id', 'submenuable_id');
            $table->string('title')->nullable()->change();
            $table->string('url')->nullable()->change();
            $table->string('submenuable_type')->nullable()->after('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
