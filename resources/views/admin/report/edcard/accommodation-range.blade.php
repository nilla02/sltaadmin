<x-admin-master>

    @section('content')

    <form action="" method="post">
        @csrf
        <input type="text" list="property" name="property" value="@isset($EDCardArrivals){{$propertyName}}@endisset" placeholder="Search for a property" required>
        <datalist id="property">
            @foreach ($properties as $property)
            <option value="{{$property->name}}">
                @endforeach
        </datalist>

        <input type="date" name="start_date" value="{{$start_date}}" required>
        <input type="date" name="end_date" value="{{$end_date}}" required>
        <input type="number" name="number" value="{{$number}}" required>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button class="csv btn btn-primary float-right mr-5">Export CSV</button>

    </form>
    <br>
    @isset($EDCardArrivals)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$propertyName}} Accommodations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="EDCard-accommodation-range" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country Name</th>
                            <th>Guest Age</th>
                            <th>Similar Names</th>
                            <th>Date of Entry</th>
                            <th>Length of Stay</th>
                            <th>Created At</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php $num = 0; ?>
                        @foreach ($EDCardArrivals as $EDCardArrival)
                        @if ($EDCardArrival->check == null)
                        <tr>
                            <td>{{$EDCardArrival->CardRecordID}}</td>
                            <td>{{$EDCardArrival->FirstName}}</td>
                            <td>{{$EDCardArrival->LastName}}</td>
                            <td>{{$EDCardArrival->CountryName}}</td>
                            <td>{{$EDCardArrival->DateOfBirth->diffForHumans(null, true)}}</td>
                            <td class="pl-4">
                                <ul class="m-0 p-0">
                                    @foreach ($options[$num] as $options[$num])
                                    @foreach ($options[$num] as $option)
                                    @isset($option->firstName)
                                    @if ($EDCardArrival->FirstName == '`')
                                    @else
                                    <li>{{$option->firstName}} {{$option->lastName}} ( {{$option->ageOfGuest}} @if ($option->ageOfGuest == 1)
                                        year
                                        @else
                                        years
                                        @endif)</li>
                                    @endif
                                    @endisset
                                    @endforeach
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$EDCardArrival->DateOfEntry}}</td>
                            <td>{{$EDCardArrival->LengthOfStay}} days</td>
                            <td>{{$EDCardArrival->CreatedDate->diffForHumans()}}</td>
                            <td>{{$EDCardArrival->CreatedDate}}</td>
                        </tr>
                        @endif
                        <?php $num += 1; ?>
                        @endforeach
                    </tbody>
                    <tfoot class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country Name</th>
                            <th>Guest Age</th>
                            <th>Similar Names</th>
                            <th>Date of Entry</th>
                            <th>Length of Stay</th>
                            <th>Created At</th>
                            <th>Date Created</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endisset

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('js/csv.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

    @endsection

</x-admin-master>