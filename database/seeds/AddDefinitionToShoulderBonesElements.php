<?php

use Illuminate\Database\Seeder;
use App\Models\Element;
use App\Models\Definition;

class AddDefinitionToShoulderBonesElements extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $clavicula = Element::where(['name' => 'Clavícula'])->get()->first();
      Definition::store_definition([
        'element_id' => $clavicula->id,
        'definition' => "Única unión ósea entre el tronco y la extremidad superior."
      ]);
      Definition::store_definition([
        'element_id' => $clavicula->id,
        'definition' => "La porción medial es convexa hacia delante, mientras que  la porción lateral es cóncava."
      ]);
      Definition::store_definition([
        'element_id' => $clavicula->id,
        'definition' => "El extremo acromial de la clavícula es plano, tiene una carilla ovalada para articularse con una carilla similar en el acromion de la escápula."
      ]);
      $escapula = Element::where(['name' => 'Escápula'])->get()->first();
      Definition::store_definition([
        'element_id' => $escapula->id,
        'definition' => "La escápula se describe como un hueso grande, plano y triangular"
      ]);
      Definition::store_definition([
        'element_id' => $escapula->id,
        'definition' => "Tres ángulos: lateral, superior e inferior."
      ]);
      Definition::store_definition([
        'element_id' => $escapula->id,
        'definition' => "Tres bordes: Lateral, superior y medial."
      ]);
      Definition::store_definition([
        'element_id' => $escapula->id,
        'definition' => "Dos superficies: Costal y posterior."
      ]);
      $humero = Element::where(['name' => 'Húmero'])->get()->first();
      Definition::store_definition([
        'element_id' => $humero->id,
        'definition' => ""
      ]);
      Definition::store_definition([
        'element_id' => $humero->id,
        'definition' => "El extremo proximal del húmero está formado por:"
      ]);
      Definition::store_definition([
        'element_id' => $humero->id,
        'definition' => "La cabeza, con forma semiesférica, se proyecta en sentido superior y medial. Se articula con la cavidad glenoidea de la escápula."
      ]);
      Definition::store_definition([
        'element_id' => $humero->id,
        'definition' => "El cuello anatómico circunscribe la cabeza y la separa de los tubérculos mayor y menor."
      ]);
    }
}
