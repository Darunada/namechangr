<?php

namespace App\Http\Controllers\States;


use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Location\State;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use mikehaertl\pdftk\Pdf;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UtController extends Controller
{

    protected $state;

    public function __construct() {

        $this->middleware('guest-notification');

        $this->state = State::where('name', 'Utah')->first();

    }

    protected function guardRequest($application) {
        if($application == null) {
            throw new AccessDeniedException('Please start an application!');
        }

        if($application->state_id != $this->state->id) {
            throw new AccessDeniedException("Somehow you got my '{$this->state->name}' generator for your '{$application->state->name}' application");
        }

        if($application->user_id != null && Auth::id() != $application->user_id) {
            throw new AccessDeniedException("You don't have permission!");
        }
    }

    public function index(Request $request, Application $application = null) {
        try {
            $this->guardRequest($application);
        } catch(AccessDeniedException $e) {
            flash($e->getMessage())->error()->important();
            return redirect('dashboard');
        }

        dump($application);
        dump(Auth::user());
        dd('henlo thot');
    }


    public function generateSexOffenderRegistryForm() {
        /*
        legal_name:Lea Rae Fairbanks
        dob:06/11/1989
        phone:262-370-4052
        email:lea.rae.fairbanks@gmail.com
        dl_number:1234567890
        dl_state:52
        address[address1]:43 E 8800 S
        address[city]:Sandy
        address[state]:52
        address[zipcode]:84070
      */
        $states = new States();
        $address_city = Input::post('address.city');
        $address_state = $states->getOne(Input::post('address.state'))['iso_3166_2'];
        $address_zipcode = Input::post('address.zipcode');
        $address2 = "$address_city, $address_state $address_zipcode";

        $dl_number = Input::get('dl_number');
        $dl_state = $states->getOne(Input::post('dl_state'))['iso_3166_2'];

        $county = County::findOrFail(Input::post('county_id'));
        $district = District::findOrFail(Input::post('district_id'));
        $location = Location::findOrFail(Input::post('location_id'));

        $data = array(
            'name' => Input::post('legal_name'),
            'address1' => Input::post('address.address1'),
            'address2' => $address2,
            'phone' => Input::post('phone'),
            'email' => Input::post('email'),
            'district' => $district->name,
            'county' => $county->name,
            'location' => $location->address,
            'dob' => Input::post('dob'),
            'dl_number' => "$dl_number $dl_state"
        );

        return view('docs.UT.sex_offender_registry.full', $data);
    }

    public function generateCoverSheetForm() {
        /*
        legal_name:Lea Rae Fairbanks
        dob:06/11/1989
        phone:262-370-4052
        email:lea.rae.fairbanks@gmail.com
        dl_number:1234567890
        dl_state:52
        address[address1]:43 E 8800 S
        address[city]:Sandy
        address[state]:52
        address[zipcode]:84070
      */
//        $states = new States();
//        $address_city = Input::get('address.city');
//        $address_state = $states->getOne(Input::get('address.state'))['iso_3166_2'];
//        $address_zipcode = Input::get('address.zipcode');
//        $address2 = "$address_city, $address_state $address_zipcode";
//
//        $dl_number = Input::get('dl_number');
//        $dl_state = $states->getOne(Input::get('dl_state'))['iso_3166_2'];
//
//        $county = County::findOrFail(Input::get('county_id'));
//        $district = District::findOrFail(Input::get('district_id'));
//        $location = Location::findOrFail(Input::get('location_id'));
//
//        $data = array(
//            'name' => Input::get('legal_name'),
//            'address1' => Input::get('address.address1'),
//            'address2' => $address2,
//            'phone' => Input::get('phone'),
//            'email' => Input::get('email'),
//            'district' => $district->name,
//            'county' => $county->name,
//            'location' => $location->address,
//            'dob' => Input::get('dob'),
//            'dl_number' => "$dl_number $dl_state"
//        );

        return view('docs.UT.cover_page.full'/*, $data*/);
    }

}
