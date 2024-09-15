<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('bimonthly');
            $table->float('maximum_score');
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
        });
        Schema::table('scores', function (Blueprint $table) {
            $table->foreignId('test_id')
            ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropForeign(['test_id']);
            $table->dropColumn('test_id');
        });

        Schema::dropIfExists('tests');
    }
};
