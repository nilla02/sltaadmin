<x-admin-master>

    @section('content')
    <h1 class="text-center">Pending Properties</h1>

    @foreach ($properties as $property)

    <a href="{{ url($property->id.'/pending-property')}}" class="btn btn-primary">{{$property->prefix.$property->id}}-12-2020<br>{{$property->name}}</a>

    @endforeach

    @endsection

</x-admin-master>