<x-admin-master>
    @section('content')

    <h3 class="text-center mb-5">Connect the Properties to the ED Card System</h3>

    <form action="{{route('admin.edcard.connect')}}" method="post">
        @csrf
        @method('PUT')
        <div class="columns2">
            <div class="column">
                <h4>SLTA Levy System</h4>
            </div>
            <div class="column">
                <h4>ED Card System</h4>
            </div>
            <div class="column">
                @foreach ($properties as $property)
                <div class="property">
                    <input type="radio" id="{{$property->name}}" name="property" value="{{$property->id}}">
                    <label for="{{$property->name}}">{{$property->name}} @if ($property->EDCardName != NULL)
                        ({{$property->EDCardName}})
                        @endif</label>
                </div>
                @endforeach
            </div>
            <div class="column">
                @foreach ($EDCardProperties as $EDCardProperty)
                <div class="property">
                    <input type="radio" id="ED-{{$EDCardProperty->AccommodationProperty}}" name="EDCardProperty" value="{{$EDCardProperty->AccommodationPropertyID}}">
                    <label for="ED-{{$EDCardProperty->AccommodationProperty}}">{{$EDCardProperty->AccommodationProperty}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="property">
            <div class="text-center mt-5">
                <button class="button-2" type="reset">Reset</button>
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>

    @endsection

</x-admin-master>