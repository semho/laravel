<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(3)->after('name');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'role_id' => '1',
                'email' => 'admin@mail.ru',
                'email_verified_at' => DB::raw('CURRENT_TIMESTAMP'),
                'password' => '$2y$10$mo4ILwfLfu48h3HIeutMf.m3Wtz4PusktQoFhauvp65qvEGOToKRu',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
}
