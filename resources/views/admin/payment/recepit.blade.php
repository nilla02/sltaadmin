<x-admin-master>
    @section('content')

    <a href="{{route('admin.recepits')}}" class="none">
        <i class="fas fa-arrow-left pr5"></i>Back to Recepits
    </a>

    <div class="receipt-content">
        <div class="invoice-wrapper mb-5">
            <div class="mb-5">
                <img src="{{asset('img/saintluciablue.png')}}" height="80" width="auto">
            </div>
            <div class="payment-info">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Recepit No.</span>
                        <strong>
                            @if ($recepit->number != '')
                            {{ $recepit->number }}
                            @else
                            {{ $recepit->sage_system_id }}
                            @endif
                        </strong>
                    </div>
                    <div class="col-sm-6 text-right">
                        <span>Payment Date</span>
                        <strong>
                            {{ date('dS F, Y', strtotime($recepit->date))}}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="payment-details">
                <div class="row">
                    <div class="col-sm-6">
                        <span>Client</span>
                        <strong>
                            {{$recepit->property_name}}
                        </strong>
                        @if ($property)

                        <br>
                        <br>
                        <p>
                            {{$property->Location}}
                            <br>
                            {{$property->mailingAddress}}
                            <br>
                            <a href="mailto: {{$property->accountantEmail}}">
                                {{$property->accountantEmail}}
                            </a>
                            <br>
                            <a href="mailto: {{$property->primaryContactEmail}}">
                                @if($property->accountantEmail != $property->primaryContactEmail)
                                {{$property->primaryContactEmail}}
                                @endif
                            </a>
                        </p>
                        @endif

                    </div>
                    <div class="col-sm-6 text-right">
                        <span>Payment To</span>
                        <strong>
                            Saint Lucia Tourism Authority
                        </strong>
                        <br>
                        <br>
                        <p>
                            33G3+M2M <br>
                            Rodney Bay <br>
                            St. Lucia <br>
                            <a href="tel:758-458-7101">
                                +1 758-458-7101
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="line-items">
                <div class="headers clearfix">
                    <div class="col-xs-4">Description</div>
                    <div class="col-xs-5 text-right">Amount</div>
                </div>
                <div class="items">
                    <div class="col-xs-4 desc">
                        @if ($recepit->title != '')
                        {{ $recepit->title }}
                        @else
                        {{ $recepit->reference }}
                        @endif
                    </div>
                    <div class="col-xs-5 amount text-right">
                        ${{$recepit->amount}} {{$recepit->currency}}
                    </div>
                </div>
                <div class="total text-right">
                    <div class="field">
                        Subtotal <span>${{$recepit->amount}} {{$recepit->currency}}</span>
                    </div>
                    <div class="field grand-total">
                        Total <span>${{$recepit->amount}} {{$recepit->currency}}</span>
                    </div>
                </div>

                <div class="print none pointer">
                    <a onclick="printContext()" role="button" name="print">
                        <i class="fa fa-print"></i>
                        Print this receipt
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endsection
</x-admin-master>