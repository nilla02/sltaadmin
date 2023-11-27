<x-admin-master>

    @section('content')
    <div class="float-right">
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#acceptModal">
            Accept
        </a>
        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#denyModal">
            Pending Info
        </a>
    </div>

    <!-- Accept Modal-->
    <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Complete Action</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">You are about to accept this property.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/{{$property->id}}/pending-property" method="post">
                        @csrf

                        <button class="btn btn-primary">Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Modal-->
    <div class="modal fade" id="denyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Complete Action</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You are about to require this Accommodation Provider to make changes to this registration form.</p>
                    <form action="{{route('admin.formChange', $property->id)}}" method="post" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="grid-2 mb-4">
                            <div>
                                <input type="checkbox" id="name" name="name" value="1">
                                <label for="name">Name of Applicant</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tradeName" name="tradeName" value="1">
                                <label for="tradeName">Trade Name</label>
                            </div>
                            <div>
                                <input type="checkbox" id="vatTaxpayerAccount" name="vatTaxpayerAccount" value="1">
                                <label for="vatTaxpayerAccount">VAT Taxpayer Account</label>
                            </div>
                            <div>
                                <input type="checkbox" id="Location" name="Location" value="1">
                                <label for="Location">Location</label>
                            </div>
                            <div>
                                <input type="checkbox" id="mailingAddress" name="mailingAddress" value="1">
                                <label for="mailingAddress">Mailing Address</label>
                            </div>
                            <div>
                                <input type="checkbox" id="noOfRooms" name="noOfRooms" value="1">
                                <label for="noOfRooms">No Of Rooms</label>
                            </div>
                            <div>
                                <input type="checkbox" id="typeOfProperty" name="typeOfProperty" value="1">
                                <label for="typeOfProperty">Type Of Property</label>
                            </div>
                            <div>
                                <input type="checkbox" id="ownerName" name="ownerName" value="1">
                                <label for="ownerName">Owner Name</label>
                            </div>
                            <div>
                                <input type="checkbox" id="ownerPosition" name="ownerPosition" value="1">
                                <label for="ownerPosition">Owner Position</label>
                            </div>
                            <div>
                                <input type="checkbox" id="ownerEmail" name="ownerEmail" value="1">
                                <label for="ownerEmail">Owner Email</label>
                            </div>
                            <div>
                                <input type="checkbox" id="managerName" name="managerName" value="1">
                                <label for="managerName">Manager Name</label>
                            </div>
                            <div>
                                <input type="checkbox" id="managerPosition" name="managerPosition" value="1">
                                <label for="managerPosition">Manager Position</label>
                            </div>
                            <div>
                                <input type="checkbox" id="managerEmail" name="managerEmail" value="1">
                                <label for="managerEmail">Manager Email</label>
                            </div>
                            <div>
                                <input type="checkbox" id="accountantName" name="accountantName" value="1">
                                <label for="accountantName">Accountant Name</label>
                            </div>
                            <div>
                                <input type="checkbox" id="accountantPosition" name="accountantPosition" value="1">
                                <label for="accountantPosition">Accountant Position</label>
                            </div>
                            <div>
                                <input type="checkbox" id="accountantEmail" name="accountantEmail" value="1">
                                <label for="accountantEmail">Accountant Email</label>
                            </div>
                            <div>
                                <input type="checkbox" id="primaryContactName" name="primaryContactName" value="1">
                                <label for="primaryContactName">Primary Contact Name</label>
                            </div>
                            <div>
                                <input type="checkbox" id="primaryContactPosition" name="primaryContactPosition" value="1">
                                <label for="primaryContactPosition">Primary Contact Position</label>
                            </div>
                            <div>
                                <input type="checkbox" id="primaryContactEmail" name="primaryContactEmail" value="1">
                                <label for="primaryContactEmail">Primary Contact Email</label>
                            </div>
                            <div>
                                <input type="checkbox" id="applicableClassAndRate" name="applicableClassAndRate" value="1">
                                <label for="applicableClassAndRate">Applicable Class And Rate</label>
                            </div>
                            <div>
                                <input type="checkbox" id="pendingDocuments" name="pendingDocuments" value="1">
                                <label for="pendingDocuments">Pending Documents</label>
                            </div>
                        </div>
                        <p>Send a Message to the Accommodation Provider</p>
                        <textarea name="message" id="" class="message"></textarea>
                        <div class="modal-footer ">
                            <button class="btn btn-danger">Request Change</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

    <a href="{{route('admin.penProperty')}}">
        <i class="fas fa-arrow-left pr5"></i>Back to Pending Properties
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
            Government Issue ID
        </h1>
        <div class="item">
            <embed src="{{asset('docs/'.$property->government_id)}}" alt="" class="document2">
        </div>
    </div>

    <div class="sec1">
        <h1 class="collector-title">
            Applicant Signature
        </h1>
        <div class="item">
            <embed src="{{asset('docs/'.$property->signed)}}" alt="" class="document2">
        </div>
    </div>
    <div class="sec1">
        <h1 class="collector-title">
            Copy Of VAT Registration
        </h1>
        <div class="">
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


    <div class="d-flex justify-content-center mb-5">
        <a class="btn btn-primary mr-2 ml-2" href="#" data-toggle="modal" data-target="#acceptModal">
            Accept
        </a>
        <a class="btn btn-danger mr-2 ml-2" href="#" data-toggle="modal" data-target="#denyModal">
            Pending Info
        </a>
    </div>
    @endsection

</x-admin-master>