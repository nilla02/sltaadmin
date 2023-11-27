<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collector;
use App\Models\Property;
use App\Models\WebProperty;
use Illuminate\Support\Facades\DB;

use App\Models\WebUser;

class PropertyController extends AdminsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function penProperty()
    {
        $properties = Property::select('id', 'name')->where('accepted', 0)->orderBy('id', 'DESC')->get();
        foreach ($properties as $property) {
            $this->prefix($property);
            $this->suffix($property);
        }
        return view('admin.properties.penProperty', ['properties' => $properties]);
    }

    public function onePenProperty($property)
    {
        $property = Property::where('id', $property)->where('accepted', 0)->firstOrFail();

        $this->prefix($property);
        $this->suffix($property);
        $this->applicableClassAndRate($property);

        return view('admin.properties.onePenProperty', ['property' => $property]);
    }

    public function oneAcceptingProperty($property)
    {
        property::where('id', $property)->update(array('accepted' => 1));
        WebProperty::where('id', $property)->update(array('accepted' => 1));

        $property = Property::findOrFail($property);
        $collector = $property->collectors->firstOrFail();

        if (isset($collector)) {
            if ($collector->accepted == 0) {
                Collector::where('id', $collector->id)->update(array('accepted' => 1));
                WebUser::where('id', $collector->id)->update(array('accepted' => 1));
            }
        }

        return $this->penProperty();
    }

    public function appProperty()
    {

        $properties = Property::select('id', 'name', 'tradeName', 'vatTaxpayerAccount')->where('accepted', 1)->orderBy('id', 'DESC')->get();
        foreach ($properties as $property) {
            $this->prefix($property);
            $this->suffix($property);
        }
        return view('admin.properties.appProperty', ['properties' => $properties]);
    }

    public function oneAppProperty($property)
    {
        $property = Property::where('id', $property)->where('accepted', 1)->firstOrFail();

        $this->prefix($property);
        $this->suffix($property);
        $this->applicableClassAndRate($property);

        return view('admin.properties.oneAppProperty', ['property' => $property]);
    }

    public function formChange(Request $request, $property)
    {
        $arr = array();
        if ($request->name == 1) {
            $arr['name'] = "";
        }
        if ($request->tradeName == 1) {
            $arr['tradeName'] = "";
        }
        if ($request->vatTaxpayerAccount == 1) {
            $arr['vatTaxpayerAccount'] = "";
        }
        if ($request->Location == 1) {
            $arr['Location'] = "";
        }
        if ($request->mailingAddress == 1) {
            $arr['mailingAddress'] = "";
        }
        if ($request->noOfRooms == 1) {
            $arr['noOfRooms'] = "";
        }
        if ($request->typeOfProperty == 1) {
            $arr['typeOfProperty'] = "";
        }
        if ($request->ownerName == 1) {
            $arr['ownerName'] = "";
        }
        if ($request->ownerPosition == 1) {
            $arr['ownerPosition'] = "";
        }
        if ($request->ownerEmail == 1) {
            $arr['ownerEmail'] = "";
        }
        if ($request->managerName == 1) {
            $arr['managerName'] = "";
        }
        if ($request->managerPosition == 1) {
            $arr['managerPosition'] = "";
        }
        if ($request->managerEmail == 1) {
            $arr['managerEmail'] = "";
        }
        if ($request->accountantName == 1) {
            $arr['accountantName'] = "";
        }
        if ($request->accountantPosition == 1) {
            $arr['accountantPosition'] = "";
        }
        if ($request->accountantEmail == 1) {
            $arr['accountantEmail'] = "";
        }
        if ($request->primaryContactName == 1) {
            $arr['primaryContactName'] = "";
        }
        if ($request->primaryContactPosition == 1) {
            $arr['primaryContactPosition'] = "";
        }
        if ($request->primaryContactEmail == 1) {
            $arr['primaryContactEmail'] = "";
        }
        if ($request->applicableClassAndRate == 1) {
            $arr['applicableClassAndRate'] = "";
        }
        if ($request->pendingDocuments == 1) {
            $arr['pendingDocuments'] = 1;
        }

        Property::where('id', $property)->update($arr);
        WebProperty::where('id', $property)->update($arr);

        return redirect()->route('admin.onePenProperty', $property);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
