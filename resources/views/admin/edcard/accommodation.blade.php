<x-admin-master>
    @section('content')

    <form action="" method="post">
        @csrf
        <input type="text" list="property" name="property" placeholder="Search for a property">
        <datalist id="property">
            @foreach ($properties as $property)
            <option value="{{$property->name}}">
                @endforeach
        </datalist>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    @isset($EDCardProperties)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$propertyName}} Accommodations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="property-accommodation" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Database</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country Name</th>
                            <th>Guest Age</th>
                            <th>Created At</th>
                            <th>Date Created</th>
                            <th>Length Of Stay</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($EDCardProperties as $EDCardProperty)
                        <tr>
                            <td>{{$EDCardProperty->CardRecordID}}</td>
                            <td>ED Card System</td>
                            <td>{{$EDCardProperty->FirstName}}</td>
                            <td>{{$EDCardProperty->LastName}}</td>
                            <td>{{$EDCardProperty->CountryName}}</td>
                            <td>{{$EDCardProperty->DateOfBirth->diffForHumans(null, true)}}</td>
                            <td>{{$EDCardProperty->CreatedDate->diffForHumans()}}</td>
                            <td>{{$EDCardProperty->CreatedDate}}</td>
                            <td>{{$EDCardProperty->LengthOfStay}} days</td>
                        </tr>
                        @endforeach
                        @foreach ($accommodations as $accommodation)
                        <tr>
                            <td>{{$accommodation->id}}</td>
                            <td>SLTA Levy Portal</td>
                            <td>{{$accommodation->firstName}}</td>
                            <td>{{$accommodation->lastName}}</td>
                            <td></td>
                            <td>{{$accommodation->ageOfGuest}}</td>
                            <td>{{$accommodation->arrivalDate->diffForHumans()}}</td>
                            <td>{{$accommodation->arrivalDate}}</td>
                            <td>{{$accommodation->numberOfNights}} days</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Database</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country Name</th>
                            <th>Guest Age</th>
                            <th>Created At</th>
                            <th>Date Created</th>
                            <th>Length Of Stay</th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endisset


    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>