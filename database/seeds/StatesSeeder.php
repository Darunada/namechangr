<?php

use App\Models\Location\State;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        // Check if the seeder has already run
        $states = State::all()->count();
        return $states > 0 or $this->populateStates();
    }

    protected function populateStates()
    {
        //Get all of the states
        $states = States::getList();
        foreach ($states as $stateId => $state) {
            DB::table(Config::get('states.table_name'))->insert(array(
                                                                     'id' => $stateId,
                                                                     'iso_3166_2' => $state['iso_3166_2'],
                                                                     'name' => $state['name'],
                                                                     'country_code' => $state['country_code'],
                                                                     'active' => false
                                                                 ));
        }
    }
}
