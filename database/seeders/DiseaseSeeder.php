<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disease;
use App\Models\Question;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dengue = Disease::create([
            'name' => 'Dengue',
        ]);

        $questions = [
            ['name' => '¿Posee usted dolor articular?', 'isDanger' => false],
            ['name' => '¿Tiene fiebre alta?', 'isDanger' => false],
            ['name' => '¿Tiene erupciones en la piel?', 'isDanger' => false],
            ['name' => '¿Siente dolor de cabeza?', 'isDanger' => false],
            ['name' => '¿Tiene náuseas o vómitos?', 'isDanger' => false],

            ['name' => '¿Tiene dolor abdominal intenso y continuo?', 'isDanger' => true],
            ['name' => '¿Tiene vómitos persistentes?', 'isDanger' => true],
            ['name' => '¿Tiene sangrado de encías, nariz o en la orina?', 'isDanger' => true],
            ['name' => '¿Tiene sangrado bajo la piel (petequias o equimosis)?', 'isDanger' => true],
            ['name' => '¿Tiene dificultad para respirar?', 'isDanger' => true],
            ['name' => '¿Siente fatiga extrema o irritabilidad?', 'isDanger' => true],

            ['name' => '¿Tiene hemorragias severas (por ejemplo, sangrado gastrointestinal)?', 'isDanger' => true],
            ['name' => '¿Tiene choque por dengue (caída drástica de la presión arterial)?', 'isDanger' => true],
            ['name' => '¿Tiene daño orgánico (como insuficiencia hepática o renal)?', 'isDanger' => true],
            ['name' => '¿Tiene acumulación de líquidos en el cuerpo (por ejemplo, en los pulmones o el abdomen)?', 'isDanger' => true],
        ];

        foreach ($questions as $question) {
            Question::create([
                'disease_id' => $dengue->id,
                'name' => $question['name'],
                'isDanger' => $question['isDanger'],
            ]);
        }
    }
}
