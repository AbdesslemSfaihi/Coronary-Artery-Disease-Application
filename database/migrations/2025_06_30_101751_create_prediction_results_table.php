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
        Schema::create('prediction_results', function (Blueprint $table) {
            $table->id();
            $table->integer('Age');
            $table->boolean('Sexe');
            $table->boolean('Antécédants_médicaux_BPCO');
            $table->integer('Antécédants_médicaux_Diabète_ancienneté');
            $table->boolean('Antécédants_médicaux_HTA');
            $table->boolean('Antécédants_médicaux_HTA_HVG_électrique');
            $table->integer('Antécédants_médicaux_HTA_ancienneté');
            $table->integer('Antécédants_médicaux_IMC_classe');
            $table->integer('Antécédants_médicaux_insuffisance_rénale_ancienneté');
            $table->float('Biologie_CRP');
            $table->integer('Biologie_ClasseMDRD');
            $table->float('Biologie_GAJ');
            $table->float('Biologie_HDL-C');
            $table->float('Biologie_HbA1C');
            $table->float('Biologie_Non_HDL');
            $table->float('ECG_End_ST_amplitude');
            $table->float('ECG_PR_interval');
            $table->float('ECG_Mid_ST_amplitude');
            $table->boolean('ECG_Poor_R_wave_progression');
            $table->boolean('ECG_PVC');
            $table->boolean('ECG_Q_wave');
            $table->float('ECG_QRS_duration');
            $table->boolean('ECG_QRS_fragmentation');
            $table->float('ECG_TPE');
            $table->boolean('Habitudes_Tabagisme');
            $table->boolean('Habitudes_Tabagisme_ancien');
            $table->boolean('Symptomes_Douleur');
            $table->boolean('Symptomes_Douleur_déclenchement');
            $table->boolean('prediction'); // 0 or 1
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_results');
    }
};
