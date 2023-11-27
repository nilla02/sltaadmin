<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $last_month = date('Y-m', strtotime(today() . ' - ' . '1 months'));
        $number = 2;
        $properties = Property::select('EDCardPropertyId', 'name')->OrderBy('name')->get();

        if (isset($request->property) and isset($request->date)) {

            $date = explode("-", $request->date);
            $number = $request->number;

            $year = $date[0];
            $month = $date[1];

            $property = Property::select('id', 'EDCardPropertyId')->where('name', $request->property)->first();

            $EDCardArrivals = DB::connection('EdCard')->select("
            select CardRecordID, FirstName, LastName, CountryName, DateOfBirth, DateOfEntry, LengthOfStay, CardRecord_Arrival.CreatedDate 
            from dbo.CardRecord_Arrival join dbo.Country on 
            CardRecord_Arrival.ResidenceCountryID=Country.CountryID Where (DATEPART(yy, DateOfEntry) 
            = $year AND DATEPART(mm, DateOfEntry) = $month) AND (AccomodationPropertyID = $property->EDCardPropertyId AND FirstName 
            IS NOT NULL AND NOT FirstName = '') Order by CardRecordID desc");


            $accommodations = Accommodation::select('id', 'arrivalDate', 'firstName', 'lastName')->where('property_id', $property->id)->where('arrivalDate', 'like', $request->date . '%')->get();

            $num = 0;

            foreach ($EDCardArrivals as $EDCardArrival) {

                $EDCardArrival->CreatedDate = Carbon::parse($EDCardArrival->CreatedDate);
                $EDCardArrival->DateOfBirth = Carbon::parse($EDCardArrival->DateOfBirth);
                $lastTwoCharsFirstName = addslashes(substr("$EDCardArrival->FirstName", -$number));
                $lastTwoCharsLastName = addslashes(substr("$EDCardArrival->LastName", -$number));
                $firstTwoCharsFirstName = addslashes(substr("$EDCardArrival->FirstName", 0, $number));
                $firstTwoCharsLastName = addslashes(substr("$EDCardArrival->LastName", 0, $number));
                $EDCardArrival->check = 0;

                foreach ($accommodations as $accommodation) {
                    if (strtolower($EDCardArrival->FirstName) == strtolower($accommodation->firstName) and strtolower($EDCardArrival->LastName) == strtolower($accommodation->lastName)) {
                        $EDCardArrival->check = 1;
                    } else {
                        $EDCardArrival->check = 0;
                    }
                }


                $names = DB::select("select id, firstName, lastName, ageOfGuest from accommodations where property_id = $property->id AND arrivalDate like '$request->date%' 
                     AND (firstName like '%$lastTwoCharsFirstName' OR firstName like '$firstTwoCharsFirstName%' OR lastName like '%$lastTwoCharsLastName' OR lastName like '$firstTwoCharsLastName%')");

                $options[] = array($num => $names);

                $num += 1;
            }

            return view('admin.report.edcard.accommodation', ['properties' => $properties, 'EDCardArrivals' => $EDCardArrivals, 'propertyName' => $request->property, 'options' => $options, 'date' => $request->date, 'number' => $number]);
        } else {
            return view('admin.report.edcard.accommodation', ['properties' => $properties, 'date' => $last_month, 'number' => $number]);
        }
    }

    public function indexrange(Request $request)
    {
        $start_month = date('Y-m-d', strtotime(today() . ' - ' . '1 months'));
        $end_month = date('Y-m-d', strtotime(today()));
        $properties = Property::select('EDCardPropertyId', 'name')->OrderBy('name')->get();
        $number = 2;

        if (isset($request->property) and isset($request->start_date) and isset($request->end_date)) {

            $options = array();
            $property = Property::select('id', 'EDCardPropertyId')->where('name', $request->property)->first();

            $start_dates = (explode("-", $request->start_date));
            $start_date = "$start_dates[0]$start_dates[1]$start_dates[2]";
            $number = $request->number;

            $end_dates = (explode("-", $request->end_date));
            $end_date = "$end_dates[0]$end_dates[1]$end_dates[2]";

            $EDCardArrivals = DB::connection('EdCard')->select("
            select CardRecordID, FirstName, LastName, CountryName, DateOfBirth, DateOfEntry, LengthOfStay, CardRecord_Arrival.CreatedDate 
            from dbo.CardRecord_Arrival join dbo.Country on 
            CardRecord_Arrival.ResidenceCountryID=Country.CountryID Where (DateOfEntry >= '$start_date' AND DateOfEntry <= '$end_date') AND (AccomodationPropertyID = $property->EDCardPropertyId AND FirstName 
            IS NOT NULL AND NOT FirstName = '') Order by CardRecordID desc");

            $accommodations = Accommodation::select('id', 'arrivalDate', 'firstName', 'lastName')->where('property_id', $property->id)->whereBetween('arrivalDate', [$request->start_date, $request->end_date])->get();

            $num = 0;
            foreach ($EDCardArrivals as $EDCardArrival) {

                $EDCardArrival->CreatedDate = Carbon::parse($EDCardArrival->CreatedDate);
                $EDCardArrival->DateOfBirth = Carbon::parse($EDCardArrival->DateOfBirth);
                $lastTwoCharsFirstName = addslashes(substr("$EDCardArrival->FirstName", -$number));
                $lastTwoCharsLastName = addslashes(substr("$EDCardArrival->LastName", -$number));
                $firstTwoCharsFirstName = addslashes(substr("$EDCardArrival->FirstName", 0, $number));
                $firstTwoCharsLastName = addslashes(substr("$EDCardArrival->LastName", 0, $number));

                $EDCardArrival->check = 0;

                foreach ($accommodations as $accommodation) {
                    if (strtolower($EDCardArrival->FirstName) == strtolower($accommodation->firstName) and strtolower($EDCardArrival->LastName) == strtolower($accommodation->lastName)) {
                        $EDCardArrival->check = 1;
                    } else {
                        $EDCardArrival->check = 0;
                    }
                }


                $names = DB::select("select id, firstName, lastName, ageOfGuest from accommodations where property_id = $property->id  
                     AND (firstName like '%$lastTwoCharsFirstName' OR firstName like '$firstTwoCharsFirstName%' OR lastName like '%$lastTwoCharsLastName' OR lastName like '$firstTwoCharsLastName%')");

                $options[] = array($num => $names);


                $num += 1;
            }


            return view('admin.report.edcard.accommodation-range', ['properties' => $properties, 'EDCardArrivals' => $EDCardArrivals, 'propertyName' => $request->property, 'options' => $options, 'start_date' => $request->start_date, 'end_date' => $request->end_date, 'number' => $number]);
        } else {
            return view('admin.report.edcard.accommodation-range', ['properties' => $properties, 'start_date' => $start_month, 'end_date' => $end_month, 'number' => $number]);
        }
    }

    public function levyrange(Request $request)
    {
        $start_month = date('Y-m-d', strtotime(today() . ' - ' . '1 months'));
        $end_month = date('Y-m-d', strtotime(today()));
        $properties = Property::select('EDCardPropertyId', 'name')->OrderBy('name')->get();
        $number = 2;
        $property = 'ALL';

        if (isset($request->property) and isset($request->start_date) and isset($request->end_date)) {
            $number = $request->number;

            $property = Property::select('id', 'EDCardPropertyId')->where('name', $request->property)->first();

            $start_dates = (explode("-", $request->start_date));
            $start_date = "$start_dates[0]$start_dates[1]$start_dates[2]";

            $end_dates = (explode("-", $request->end_date));
            $end_date = "$end_dates[0]$end_dates[1]$end_dates[2]";

            if ($request->property == 'ALL') {
                $EDCardArrivals = DB::connection('EdCard')->select("
                select CardRecordID, FirstName, LastName, CountryName, DateOfBirth, DateOfEntry, LengthOfStay, AccommodationProperty, CardRecord_Arrival.CreatedDate 
                from dbo.CardRecord_Arrival join dbo.Country on CardRecord_Arrival.ResidenceCountryID=Country.CountryID join dbo.AccommodationProperty on 
                CardRecord_Arrival.AccomodationPropertyID=AccommodationProperty.AccommodationPropertyID Where (DateOfEntry >= '$start_date' AND DateOfEntry <= '$end_date') 
                AND (FirstName IS NOT NULL AND NOT FirstName = '') Order by DateOfEntry");
            } else {
                $EDCardArrivals = DB::connection('EdCard')->select("
                select CardRecordID, FirstName, LastName, CountryName, DateOfBirth, DateOfEntry, LengthOfStay, AccommodationProperty, CardRecord_Arrival.CreatedDate 
                from dbo.CardRecord_Arrival join dbo.Country on CardRecord_Arrival.ResidenceCountryID=Country.CountryID join dbo.AccommodationProperty on 
                CardRecord_Arrival.AccomodationPropertyID=AccommodationProperty.AccommodationPropertyID Where (DateOfEntry >= '$start_date' AND DateOfEntry <= 
                '$end_date') AND (AccomodationPropertyID = $property->EDCardPropertyId AND FirstName IS NOT NULL AND NOT FirstName = '') Order by DateOfEntry");
            }


            if ($request->property == 'ALL') {
                $accommodations = Accommodation::with(['property'])->whereBetween('arrivalDate', [$request->start_date, $request->end_date])->get();
            } else {
                $accommodations = Accommodation::with(['property'])->where('property_id', $property->id)->whereBetween('arrivalDate', [$request->start_date, $request->end_date])->get();
            }

            foreach ($EDCardArrivals as $EDCardArrival) {

                if (isset($accommodations)) {
                    foreach ($accommodations as $accommodation) {

                        if (strtolower($EDCardArrival->FirstName) == strtolower($accommodation->firstName) and strtolower($EDCardArrival->LastName) == strtolower($accommodation->lastName)) {
                            $accommodation->EDName = $EDCardArrival->FirstName . ' ' . $EDCardArrival->LastName;
                            $accommodation->EDLengthOfStay = $EDCardArrival->LengthOfStay;
                            $accommodation->EDDateOfBirth = Carbon::parse($EDCardArrival->DateOfBirth);
                            $accommodation->EDCountryName = $EDCardArrival->CountryName;
                            $accommodation->EDProperty = $EDCardArrival->AccommodationProperty;
                            $accommodation->EDDateOfEntry = $EDCardArrival->DateOfEntry;

                            if ($accommodation->numberOfNights != $EDCardArrival->LengthOfStay) {
                                $accommodation->stayFlag = 1;
                            }

                            if ($accommodation->ageOfGuest != $accommodation->EDDateOfBirth->diffForHumans(null, true)) {
                                $accommodation->ageFlag = 1;
                            }

                            if (strtolower($accommodation->property->name) != strtolower($EDCardArrival->AccommodationProperty)) {
                                $accommodation->propertyFlag = 1;
                            }

                            $arrivalDate = $accommodation->arrivalDate . ' 00:00:00.000';
                            if ($arrivalDate != $EDCardArrival->DateOfEntry) {
                                $accommodation->arrivalFlag = 1;
                            }
                        }
                    }
                }
            }

            return view('admin.report.edcard.levy-accommodation', ['properties' => $properties, 'accommodations' => $accommodations, 'propertyName' => $request->property, 'start_date' => $request->start_date, 'end_date' => $request->end_date, 'number' => $number]);
        } else {
            return view('admin.report.edcard.levy-accommodation', ['properties' => $properties, 'start_date' => $start_month, 'propertyName' => $property, 'end_date' => $end_month, 'number' => $number]);
        }
    }
}
