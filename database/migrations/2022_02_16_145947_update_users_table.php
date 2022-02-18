<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name', 128)->after('id');
            $table->string('middle_name', 128)->nullable()->after('first_name');
            $table->string('last_name', 128)->after('middle_name');
            $table->date('birth_date')->after('last_name');
            $table->string('phone', 32)->unique()->after('birth_date');
            $table->string('password')->nullable()->change()->after('email');
            $table->string('picture')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('birth_date');
            $table->dropColumn('phone');
            $table->string('password')->change();
            $table->dropColumn('picture');
        });
    }
}
