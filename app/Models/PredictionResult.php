<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionResult extends Model
{
    protected $fillable = [
        'Age',
        'Sexe',
        'Antécédants_médicaux_BPCO',
        'Antécédants_médicaux_Diabète_ancienneté',
        'Antécédants_médicaux_HTA',
        'Antécédants_médicaux_HTA_HVG_électrique',
        'Antécédants_médicaux_HTA_ancienneté',
        'Antécédants_médicaux_IMC_classe',
        'Antécédants_médicaux_insuffisance_rénale_ancienneté',
        'Biologie_CRP',
        'Biologie_ClasseMDRD',
        'Biologie_GAJ',
        'Biologie_HDL-C',
        'Biologie_HbA1C',
        'Biologie_Non_HDL',
        'ECG_End_ST_amplitude',
        'ECG_PR_interval',
        'ECG_Mid_ST_amplitude',
        'ECG_Poor_R_wave_progression',
        'ECG_PVC',
        'ECG_Q_wave',
        'ECG_QRS_duration',
        'ECG_QRS_fragmentation',
        'ECG_TPE',
        'Habitudes_Tabagisme',
        'Habitudes_Tabagisme_ancien',
        'Symptomes_Douleur',
        'Symptomes_Douleur_déclenchement',
        'prediction'
    ];
}
