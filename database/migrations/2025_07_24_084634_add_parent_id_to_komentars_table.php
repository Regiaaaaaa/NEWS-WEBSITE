<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('komentars', function (Blueprint $table) {
        $table->unsignedBigInteger('parent_id')->nullable()->after('berita_id');
        $table->foreign('parent_id')->references('id')->on('komentars')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentars', function (Blueprint $table) {
            //
        });
    }
};
