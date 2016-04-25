<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientProjectTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table) { $table->timestamps(); });
        Schema::table('projects', function(Blueprint $table) { $table->timestamps(); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function(Blueprint $table) { $table->dropColumn(['created_at', 'updated_at']); });
        Schema::table('projects', function(Blueprint $table) { $table->dropColumn(['created_at', 'updated_at']); });
    }
}
