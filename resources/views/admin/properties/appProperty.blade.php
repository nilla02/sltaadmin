<x-admin-master>

    @section('content')
    <h1 class="text-center">Approved Properties</h1>


    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Property ID</th>
                <th scope="col">Name of Applicant</th>
                <th scope="col">Trade Name</th>
                <th scope="col">VAT Taxpayer Account</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
            <tr>
                <th scope="row"><a href="{{ url($property->id.'/approved-property')}}">{{$property->prefix.$property->id.$property->suffix}}</a></th>
                <td>{{$property->name}}</td>
                <td>{{$property->tradeName}}</td>
                <td>{{$property->vatTaxpayerAccount}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>




    @endsection

</x-admin-master>