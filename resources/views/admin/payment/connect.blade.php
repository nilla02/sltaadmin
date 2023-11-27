<x-admin-master>
    @section('content')

    <h3 class="text-center mb-5">Connect the Properties to Sage 300 clients</h3>

    <form action="{{route('admin.payment.connect')}}" method="post">
        @csrf
        @method('PUT')
        <div class="columns2">
            <div class="column">
                <h4>SLTA Levy System</h4>
            </div>
            <div class="column">
                <h4>Sage 300 System</h4>
            </div>
            <div class="column">
                @foreach ($properties as $property)
                <div class="property">
                    <input type="radio" id="levy-{{$property->name}}" name="property" value="{{$property->id}}">
                    <label for="levy-{{$property->name}}">{{$property->name}} @if ($property->SageName != NULL)
                        ({{$property->SageName}})
                        @endif</label>
                </div>
                @endforeach
            </div>
            <div class="column">
                @foreach ($SageProperties as $SageProperty)
                <div class="property">
                    <input type="radio" id="saga-{{$SageProperty->NAMECUST}}" name="SageProperty" value="{{$SageProperty->IDCUST}}">
                    <label for="saga-{{$SageProperty->NAMECUST}}">{{$SageProperty->NAMECUST}}</label>
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