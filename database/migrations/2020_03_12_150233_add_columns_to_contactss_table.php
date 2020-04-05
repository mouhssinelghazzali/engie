<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToContactssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_data', function (Blueprint $table) {

            $table->string('civilite__c')->nullable();
            $table->string('commune_pdl__c')->nullable();
            $table->string('date_fermeture_demande__c')->nullable();
            $table->string('date_reception_demande__c')->nullable();
            $table->string('numero_demande__c')->nullable();
            $table->string('raison_sociale__c')->nullable();
            $table->string('thematique_demande__c')->nullable();
            $table->string('type_enquete__c')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_data', function (Blueprint $table) {
            //
        });
    }
}
