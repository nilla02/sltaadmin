<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;


class AdminsController extends Controller
{
    protected function property_id()
    {
        return Session::get('propertyid');
    }

    protected function monthTitle($month)
    {
        if ($month == '01') {
            $monthTitle = 'January';
        } elseif ($month == '02') {
            $monthTitle = 'February';
        } elseif ($month == '03') {
            $monthTitle = 'March';
        } elseif ($month == '04') {
            $monthTitle = 'April';
        } elseif ($month == '05') {
            $monthTitle = 'May';
        } elseif ($month == '06') {
            $monthTitle = 'June';
        } elseif ($month == '07') {
            $monthTitle = 'July';
        } elseif ($month == '08') {
            $monthTitle = 'August';
        } elseif ($month == '09') {
            $monthTitle = 'September';
        } elseif ($month == '10') {
            $monthTitle = 'October';
        } elseif ($month == '11') {
            $monthTitle = 'November';
        } elseif ($month == '12') {
            $monthTitle = 'December';
        }
        return $monthTitle;
    }

    public function random_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    protected function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public function applicableClassAndRate($collector)
    {
        $acr = $collector->applicableClassAndRate;
        if ($acr == 1) {
            $collector->acrinfo = 'ADR Average Daily Rate (ADR) US$ 120 and less - Class 1 (Rate - US$3 per person/night';
        } elseif ($acr == 2) {
            $collector->acrinfo = 'ADR Average Daily Rate (ADR) US$ 121 and more - Class 2 (Rate - US$6 per person/night';
        } elseif ($acr == 3) {
            $collector->acrinfo = 'Night Rate (NR) US$ 120 and less - Class 3 (Rate - US$3 per person/night';
        } elseif ($acr == 4) {
            $collector->acrinfo = 'Night Rate (NR) US$ 121 and more - Class 4 (Rate - US$6 per person/night';
        }
    }

    function prefix($property)
    {
        $id = $property->id;

        if ($id <= 9) {
            $property->prefix = '0000';
        } elseif ($id <= 99) {
            $property->prefix = '000';
        } elseif ($id <= 999) {
            $property->prefix = '00';
        } elseif ($id <= 9999) {
            $property->prefix = '0';
        } else {
            $property->prefix = '';
        }

        return $property->prefix;
    }

    function suffix($property)
    {
        return $property->suffix = '-12-2020';
    }
}
