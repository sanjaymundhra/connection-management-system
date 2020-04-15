@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    @if($users)
        <div class="row">
            <h3>All Users</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                        @if($user->has_blocked()!=2)                 
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                @php
                                    $req_status = $user->friend_request_status();
                                @endphp
                                @if($req_status['req']=='sent')
                                    @if($req_status['status']==0)
                                        <td><span user-id="{{$user->id}}" class='request-sent'>Request Sent</span></td>
                                    @elseif($req_status['status']==1)
                                        <td><span user-id="{{$user->id}}" class='request-accepted'>Your Friend</span></td>
                                    @endif
                                @elseif($req_status['req']=='received')
                                    @if($req_status['status']==0)
                                        <td><button user-id="{{$user->id}}" class='btn request-recieved'>Accept</button></td>
                                    @elseif($req_status['status']==1)
                                        <td><span user-id="{{$user->id}}" class='request-accepted'>Your Friend</span></td>
                                    @endif
                                @else
                                    <td><button user-id="{{$user->id}}" class='btn send_friend_request'>Send Friend Request</button></td>
                                @endif
                                @if($user->is_blocked()==2)
                                    <td><button user-id="{{$user->id}}" class='btn blocked'>Blocked</button></td>
                                @else
                                    <td><button user-id="{{$user->id}}" class='btn block'>Block</button></td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
