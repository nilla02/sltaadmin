<x-admin-master>

    @section('content')


    <a href="{{route('admin.appProperty')}}">
        <i class="fas fa-arrow-left pr5"></i>Back to Approved Properties
    </a>
    <div class="sec1 ">
        <h1 class="collector-title">
            General
        </h1>
        <div class="grid-2">
            <div class="item">
                <h3>Property Registration Id</h3>
                <p>{{$property->prefix.$property->id.$property->suffix}}</p>
            </div>
            <div class="item">
                <h3>Name of Applicant</h3>
                <p>{{$property->name}}</p>
            </div>
            <div class="item">
                <h3>Trade Name</h3>
                <p>{{$property->tradeName}}</p>
            </div>
            <div class="item">
                <h3>VAT Taxpayer Account</h3>
                <p>{{$property->vatTaxpayerAccount}}</p>
            </div>
            <div class="item">
                <h3>Location</h3>
                <p>{{$property->Location}}</p>
            </div>
            <div class="item">
                <h3>Mailing Address</h3>
                <p>{{$property->mailingAddress}}</p>
            </div>
            <div class="item">
                <h3>No of Rooms</h3>
                <p>{{$property->noOfRooms}}</p>
            </div>
        </div>
    </div>

    <div class="sec1">
        <h1 class="collector-title">
            Type of Property
        </h1>
        <div>
            <div class="item">
                <p class="single">{{$property->typeOfProperty}}</p>
            </div>
        </div>
    </div>

    <div class="sec1">
        <h1 class="collector-title">
            Contact Details
        </h1>
        <div class="grid-2">
            <div class="item">
                <h3>Owner Name</h3>
                <p>{{$property->ownerName}}</p>
            </div>
            <div class="item">
                <h3>Owner Position</h3>
                <p>{{$property->ownerPosition}}</p>
            </div>
            <div class="item">
                <h3>Owner Email</h3>
                <p>{{$property->ownerEmail}}</p>
            </div>
            <div class="item">
                <h3>Manager Name</h3>
                <p>{{$property->managerName}}</p>
            </div>
            <div class="item">
                <h3>Manager Position</h3>
                <p>{{$property->managerPosition}}</p>
            </div>
            <div class="item">
                <h3>Manager Email</h3>
                <p>{{$property->managerEmail}}</p>
            </div>
            <div class="item">
                <h3>Accountant Name</h3>
                <p>{{$property->accountantName}}</p>
            </div>
            <div class="item">
                <h3>Accountant Position</h3>
                <p>{{$property->accountantPosition}}</p>
            </div>
            <div class="item">
                <h3>Accountant Email</h3>
                <p>{{$property->accountantEmail}}</p>
            </div>
            <div class="item">
                <h3>Primary Contact Name</h3>
                <p>{{$property->primaryContactName}}</p>
            </div>
            <div class="item">
                <h3>Primary Contact Position</h3>
                <p>{{$property->primaryContactPosition}}</p>
            </div>
            <div class="item">
                <h3>Primary Contact Email</h3>
                <p>{{$property->primaryContactEmail}}</p>
            </div>
        </div>
    </div>

    <div class="sec1">
        <h1 class="collector-title">
            Applicable Class and Rate:
        </h1>
        <div class="item">
            <p class="single">{{$property->acrinfo}}
            <p>
        </div>
    </div>
    <div class="sec1">
        <h1 class="collector-title">
            Applicant Signature
        </h1>
        <div class="item">
            <img src="{{asset('docs/'.$property->signed)}}" alt="">
        </div>
    </div>
    <div class="sec1">
        <h1 class="collector-title">
            Copy Of VAT Registration
        </h1>
        <div class="item">
            <embed src="{{asset('docs/'.$property->vat)}}" class="document">
        </div>
    </div>
    <div class="sec1">
        <h1 class="collector-title">
            Certificate of Incorporation and Certificate of Good Standing
        </h1>
        <div class="item">
            <embed src="{{asset('docs/'.$property->coicogs)}}" class="document">
        </div>
    </div>
    <div class="sec1">
        <h1 class="collector-title">
            Certificate of Business Name
        </h1>
        <div class="item">
            <embed src="{{asset('docs/'.$property->business)}}" class="document">
        </div>
    </div>
    @endsection

</x-admin-master>