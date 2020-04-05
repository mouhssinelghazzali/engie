<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->string('sent')->nullable();
            $table->string('failed')->nullable();
            $table->string('started')->nullable();
            $table->string('bounced')->nullable();
            $table->string('opened')->nullable();
            $table->string('skipped')->nullable();
            $table->string('finished')->nullable();
            $table->string('complaints')->nullable();
            $table->string('blocked')->nullable();
            $table->string('surveyId')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surveys', function (Blueprint $table) {
            //
        });
    }
}
