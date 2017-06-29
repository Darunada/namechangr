<?php

use App\Models\Location\State;
use Illuminate\Database\Seeder;

class UtSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        // load in the data file
        $file = File::get(__DIR__ . '/data/UT.json');

        $state = State::withoutGlobalScope(\App\Scopes\ActiveScope::class)->where('iso_3166_2', 'UT')->first();
        return $state->active OR $this->populateData($file, $state);
    }

    /**
     * @param $file
     * @param State $state
     */
    protected function populateData($file, State $state)
    {
        $stateId = $state->id;
        // init cache
        $district_list = [];
        $county_list = [];

        $contents = json_decode($file);
        $districts = $contents->districts;

        foreach ($districts as $name => $district) {

            // don't double add districts
            if (isset($district_list[$name])) {
                $districtId = $district_list[$name];
            } else {
                $districtId = DB::table('districts')->insertGetId(array(
                    'state_id' => $stateId,
                    'name' => $name
                ));

                $district_list[$name] = $districtId;
            }

            foreach ($district->counties as $county => $locations) {

                // don't double add counties
                if (isset($county_list[$county])) {
                    $countyId = $county_list[$county];
                } else {
                    $countyId = DB::table('counties')->insertGetId(array(
                        'state_id' => $stateId,
                        'name' => $county
                    ));

                    $county_list[$county] = $countyId;

                    DB::table('district_counties')->insert(array(
                        'district_id' => $districtId,
                        'county_id' => $countyId
                    ));
                }

                foreach ($locations as $location) {
                    DB::table('locations')->insert(array(
                        'district_id' => $districtId,
                        'county_id' => $countyId,
                        'address' => $location
                    ));
                }
            }
        }

        // activate the state
        $state->active = true;
        $state->save();
    }

}