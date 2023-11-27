<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EDCardController extends Controller
{
    public function connect()
    {
        $properties = Property::select('id', 'name', 'EDCardPropertyId')->OrderBy('name')->get();
        $EDCardProperties = DB::connection('EdCard')->select("select AccommodationPropertyID, AccommodationProperty from dbo.AccommodationProperty where isActive = 1 
        AND NOT AccommodationProperty = 'Not Stated' AND NOT AccommodationProperty = 'Not Applicable' AND NOT AccommodationProperty = 'Other Hotel' AND NOT 
        AccommodationProperty = 'Other Paid' AND NOT AccommodationProperty = 'Other Villa' AND NOT AccommodationProperty = 'All Nations Guest House' order by AccommodationProperty");

        foreach ($properties as $property) {
            $EDpropertyID = $property->EDCardPropertyId;
            if ($EDpropertyID != Null) {
                foreach ($EDCardProperties as $EDCardProperty) {
                    if ($EDpropertyID == $EDCardProperty->AccommodationPropertyID) {
                        $property->EDCardName = $EDCardProperty->AccommodationProperty;
                    }
                }
            } else {
                $property->EDCardName = Null;
            }
        }

        return view('admin.edcard.connect', ['properties' => $properties], ['EDCardProperties' => $EDCardProperties]);
    }

    public function update(Request $request)
    {
        $propertyID = $request->property;
        $EDCardPropertyID = $request->EDCardProperty;

        $property = Property::find($propertyID);
        $property->EDCardPropertyId = $EDCardPropertyID;
        $property->save();

        return back();
    }

    public function accommodation(Request $request)
    {
        $properties = Property::select('EDCardPropertyId', 'name')->OrderBy('name')->get();

        if (isset($request->property)) {
            $property = Property::select('id', 'EDCardPropertyId')->where('name', $request->property)->first();
            $accommodations = Accommodation::select('id', 'arrivalDate', 'firstName', 'lastName', 'ageOfGuest', 'numberOfNights', 'roomNumber')->where('property_id', $property->id)->get();
            foreach ($accommodations as $accommodation) {
                $accommodation->arrivalDate = Carbon::parse($accommodation->arrivalDate);
            }
            $EDID = $property->EDCardPropertyId;
            $EDCardProperties = DB::connection('EdCard')->select("select CardRecordID, FirstName, LastName, CountryName, DateOfBirth, LengthOfStay, CardRecord_Arrival.CreatedDate from dbo.CardRecord_Arrival join dbo.Country on CardRecord_Arrival.ResidenceCountryID=Country.CountryID Where AccomodationPropertyID = $EDID AND FirstName IS NOT NULL AND NOT FirstName = '' Order by CardRecordID desc");
            foreach ($EDCardProperties as $EDCardProperty) {
                $EDCardProperty->CreatedDate = Carbon::parse($EDCardProperty->CreatedDate);
                $EDCardProperty->DateOfBirth = Carbon::parse($EDCardProperty->DateOfBirth);
            }
            return view('admin.edcard.accommodation', ['properties' => $properties, 'EDCardProperties' => $EDCardProperties, 'accommodations' => $accommodations, 'propertyName' => $request->property]);
        } else {
            return view('admin.edcard.accommodation', ['properties' => $properties]);
        }
    }
}
