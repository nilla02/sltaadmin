<x-admin-master>

    @section('content')

    <div>
        <button class="btn btn-primary float-right mr-3">Create a User</button>
        <h1 class="ml-3">Users</h1>
    </div>
    <br>

    @if(session('user-deleted'))
    <div class="alert alert-danger">{{session('user-deleted')}}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Profile Image</th>
                            <th>Name</th>
                            <th>Roles</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <td>Delete</td>
                        </tr>

                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Profile Image</th>
                            <th>Name</th>
                            <th>Roles</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <td>Delete</td>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach($users as $user)

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td class="text-center">
                                <img height="50px" src="{{$user->avatar}}" alt="">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <div class="btn btn-secondary mb-2">{{ucfirst($role->slug);}}</div>
                                @endforeach
                            </td>
                            <td>{{$user->created_at->diffForhumans()}}</td>
                            <td>{{$user->updated_at->diffForhumans()}}</td>
                            <td>
                                <form method="post" action="{{route('user.destroy', $user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
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