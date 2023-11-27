<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recepits
                <button class="csv btn btn-primary float-right mr-5">Export CSV</button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Recepit Number</th>
                            <th>Property Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($recepits as $recepit)
                        <tr class="border-row">
                            <td>
                                <a href="{{route('admin.recepit', $recepit->id)}}">
                                    <strong>
                                        @if ($recepit->number != '')
                                        {{ $recepit->number }}
                                        @else
                                        {{ $recepit->sage_system_id }}
                                        @endif
                                    </strong>
                                </a>
                            </td>
                            <td>
                                {{$recepit->property_name}}
                            </td>
                            <td>
                                @if ($recepit->title != '')
                                {{ $recepit->title }}
                                @else
                                {{ $recepit->reference }}
                                @endif
                            </td>
                            <td>
                                ${{$recepit->amount}} {{$recepit->currency}}
                            </td>
                            <td>
                                {{ date('d F, Y', strtotime($recepit->date))}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-head">
                        <tr>
                            <th>Recepit Number</th>
                            <th>Property Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('js/csv.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>