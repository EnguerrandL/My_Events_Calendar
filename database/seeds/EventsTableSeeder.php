<?php
use Illuminate\Database\Seeder;




class EventsTableSeeder extends Seeder
{
    public function run()
    {

        // on crée un tableau dans config/categories.php
        // puis on crée une boucle pour récupérer toutes les données qui
        // nous serviront a remplir la base de donnée
        $events = config('fakeevents');
        foreach($events as $event) {
            DB::table('events')->insert([
                'event_name' => $event['event_name'],
                'event_description' => $event['event_description'],
                'event_start' => $event['event_start'],
                'event_end' => $event['event_end'],
               
            ]);
        }
    }
}


