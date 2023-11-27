<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#batchRange">Batch Range</button>
                <button class="btn btn-primary float-right mr-3" data-toggle="modal" data-target="#batch">Batch</button>
            </h6>
        </div>
        <div class="modal fade" id="batch" tabindex="-1" role="dialog" aria-labelledby="batch" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batchRange">Complete this process</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You are about to create a batch.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{route('admin.batch')}}" method="get">
                            <button type="submit" class="btn btn-primary">Create Batch</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="batchRange" tabindex="-1" role="dialog" aria-labelledby="batchRange" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batchRange">Select the date range for the batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.batchRange')}}" method="get">
                            <input type="date" name="start_date" value="{{date('Y-m-d')}}" id="">
                            <input type="date" name="end_date" value="{{date('Y-m-d')}}" id="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Batch</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="payment" width="100%" cellspacing="0">
                    <thead class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Collector (Property) Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Amount Paid</th>
                            <th>Levy System Calculated</th>
                            <th>ED Card System Calculated</th>
                            <th>Payment Type</th>
                            <th>Payment Slip</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->propertyName}}</td>
                            <td>{{$payment->firstName}}</td>
                            <td>{{$payment->lastName}}</td>
                            <td>{{$payment->collectorPosition}}</td>
                            <td>${{$payment->payment}}</td>
                            <td>${{$payment->SystemAmount}}</td>
                            <td>$</td>
                            <td>{{$payment->payment_type}}
                                @isset($payment->payment_sub_type)
                                ({{$payment->payment_sub_type}})
                                @endisset
                            </td>
                            <td>
                                @isset($payment->payment_url)
                                <button class="btn btn-secondary declaration mb-2" data-toggle="modal" data-target="#paymentFrontDoc{{$payment->id}}">
                                    Front
                                </button>
                                @endisset

                                @isset($payment->payment_back_url)
                                <button class="btn btn-secondary declaration" data-toggle="modal" data-target="#paymentBackDoc{{$payment->id}}">
                                    Back
                                </button>
                                @endisset
                            </td>
                            <td>{{$payment->created_at->diffForHumans()}}</td>
                        </tr>

                        @isset($payment->payment_url)
                        <!-- Front Modal-->
                        <div class="modal fade bd-example-modal-lg" id="paymentFrontDoc{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content" id="modal-content-doc">
                                    <div class="modal-body">
                                        <embed class="document" src="{{asset('docs/'.$payment->payment_url)}}" width="100%" height="auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endisset

                        @isset($payment->payment_back_url)
                        <!-- Back Modal-->
                        <div class="modal fade bd-example-modal-lg" id="paymentBackDoc{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content" id="modal-content-doc">
                                    <div class="modal-body">
                                        <embed class="document" src="{{asset('docs/'.$payment->payment_back_url)}}" width="100%" height="auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endisset

                        @endforeach
                    </tbody>
                    <tfoot class="table-head">
                        <tr>
                            <th>Id</th>
                            <th>Collector (Property) Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Amount Paid</th>
                            <th>Levy System Calculated</th>
                            <th>ED Card System Calculated</th>
                            <th>Payment Type</th>
                            <th>Payment Slip</th>
                            <th>Created At</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    @endsection


    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>