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
        Schema::table('contact-us', function (Blueprint $table) {
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->text('message');
            $table->enum('status',['active','inactive'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact-us', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('number');
            $table->dropColumn('message');
            $table->dropColumn('status',['active','inactive'])->default('inactive');
        });
    }
};
