<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        // Create 25 students
        for ($i = 0; $i < 25; $i++) {
            \App\Models\Eleve::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'dateNaissance' => $faker->date(),
                'numeroEtudiant' => $faker->unique()->randomNumber(8),
                'email' => $faker->unique()->safeEmail,
                'image' => $faker->imageUrl(640, 480, 'people', true, 'Faker'),
            ]);
        }


        // Create 10 modules
        for ($i = 0; $i < 10; $i++) {
            $module = \App\Models\Module::create([
                'code' => $faker->unique()->randomNumber(5),
                'name' => $faker->sentence(3),
                'coefficient' => $faker->randomNumber(1),

            ]);

            // Create 5 evaluations for each module
            for ($j = 0; $j < 5; $j++) {
                \App\Models\Evaluation::create([
                    'module_id' => $module->id,
                    'coeficient' => $faker->numberBetween(1, 5),
                    'titre' => $faker->sentence(3),
                    'date_evaluation' => $faker->date(),
                ]);
              
            }

              // Create evaluationEleves for each evaluation
              $evaluations = \App\Models\Evaluation::all();
              $eleves = \App\Models\Eleve::all();
              foreach ($evaluations as $evaluation) {
                  foreach ($eleves as $eleve) {
                      // Check if the EvaluationEleve record already exists
                      $existingEvaluationEleve = \App\Models\EvaluationEleve::where('eleve_id', $eleve->id)
                          ->where('evaluation_id', $evaluation->id)
                          ->first();
                      
                      if (!$existingEvaluationEleve) {
                          \App\Models\EvaluationEleve::create([
                              'eleve_id' => $eleve->id,
                              'evaluation_id' => $evaluation->id,
                              'note' => $faker->numberBetween(0, 20),
                          ]);
                      }
                  }
              }
        }
    }
}
