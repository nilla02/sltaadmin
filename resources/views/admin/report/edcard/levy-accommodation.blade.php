<x-admin-master>

    @section('content')

    <form action="" method="post">
        @csrf
        <input type="text" list="property" name="property" value="{{$propertyName}}" placeholder="Search for a property" required>
        <datalist id="property">
            @foreach ($properties as $property)
            <option value="{{$property->name}}">
                @endforeach
        </datalist>

        <input type="date" name="start_date" value="{{$start_date}}" required>
        <input type="date" name="end_date" value="{{$end_date}}" required>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button class="csv btn btn-primary float-right mr-5">Export CSV</button>

    </form>
    <br>
    @isset($accommodations)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$propertyName}} Accommodations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="levy-accommodation" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Levy Full Name</th>
                            <th>Levy Age Of Guest</th>
                            <th>Levy Country</th>
                            <th>Levy Property</th>
                            <th>Levy Arrival Date</th>
                            <th>Levy Number Of Nights</th>
                            <th>ED Card Full Name</th>
                            <th>ED Card Age Of Guest</th>
                            <th>ED Card Country</th>
                            <th>ED Card Property</th>
                            <th>ED Card Arrival Date</th>
                            <th>ED Card Number Of Nights</th>
                            <th>Date of Entry (LEVY)</th>
                            <th>Date Created (LEVY)</th>
                            <th>Created At (LEVY)</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($accommodations as $accommodation)
                        <tr>
                            <td>{{$accommodation->id}}</td>
                            <td>{{$accommodation->firstName.' '.$accommodation->lastName}}</td>
                            <td @if ($accommodation->ageFlag == 1)
                                class="flag-red"
                                @endif
                                >{{$accommodation->ageOfGuest}}
                                @if ($accommodation->ageOfGuest == 1)
                                year
                                @else
                                years
                                @endif
                            </td>

                            <td></td>

                            <td @if ($accommodation->propertyFlag == 1)
                                class="flag-grey"
                                @endif
                                >{{$accommodation->property->name}}</td>

                            <td @if ($accommodation->arrivalFlag == 1)
                                class="flag-orange"
                                @endif
                                >{{$accommodation->arrivalDate}}</td>

                            <td @if ($accommodation->stayFlag == 1)
                                class="flag-blue"
                                @endif
                                >{{$accommodation->numberOfNights}}
                                @if ($accommodation->numberOfNights == 1)
                                day
                                @else
                                days
                                @endif
                            </td>

                            <td>{{$accommodation->EDName}}</td>

                            <td @if ($accommodation->ageFlag == 1)
                                class="flag-red"
                                @endif>
                                @isset($accommodation->EDDateOfBirth)
                                {{$accommodation->EDDateOfBirth->diffForHumans(null, true)}}
                                @endisset
                            </td>

                            <td>{{$accommodation->EDCountryName}}</td>

                            <td @if ($accommodation->propertyFlag == 1)
                                class="flag-grey"
                                @endif>{{$accommodation->EDProperty}}</td>

                            <td @if ($accommodation->arrivalFlag == 1)
                                class="flag-orange"
                                @endif>{{$accommodation->EDDateOfEntry}}</td>

                            <td @if ($accommodation->stayFlag == 1)
                                class="flag-blue"
                                @endif>
                                @isset($accommodation->EDLengthOfStay)
                                {{$accommodation->EDLengthOfStay}}
                                @if ($accommodation->EDLengthOfStay == 1)
                                day
                                @else
                                days
                                @endif
                                @endisset
                            </td>
                            <td>{{$accommodation->numberOfNights}} days</td>
                            <td>{{$accommodation->created_at}}</td>
                            <td>{{$accommodation->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Levy Full Name</th>
                            <th>Levy Age Of Guest</th>
                            <th>Levy Country</th>
                            <th>Levy Property</th>
                            <th>Levy Arrival Date</th>
                            <th>Levy Number Of Nights</th>
                            <th>ED Card Full Name</th>
                            <th>ED Card Age Of Guest</th>
                            <th>ED Card Country</th>
                            <th>ED Card Property</th>
                            <th>ED Card Arrival Date</th>
                            <th>ED Card Number Of Nights</th>
                            <th>Date of Entry (LEVY)</th>
                            <th>Date Created (LEVY)</th>
                            <th>Created At (LEVY)</th>
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