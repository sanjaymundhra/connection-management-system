@extends('layouts.app')

@section('content')
<div class="container">
    @if($users)
        <div class='row'>
            <form action="{{route('filtered.users')}}" method='GET' class='form-inline'>
                @csrf
                <div class='form-group'>
                    <label class="control-label" for="filter_gender">Gender</label>
                    <select name="filter_gender" id="filter_gender" class='form-control'>
                        <option value=''>All</option>
                        <option value="male" {{Request::get('filter_gender')=='male'?'selected':''}}>Male</option>
                        <option value="female" {{Request::get('filter_gender')=='female'?'selected':''}}>Female</option>
                    </select>
                </div>
                @if($hobbies)
                    <div class='form-group'>
                        <label class="control-label" for="filter_hobby">Hobbies</label>
                        <select name="filter_hobby" id="filter_hobby" class='form-control'>
                            <option value=''>All</option>
                            @foreach ($hobbies as $hobby)                                
                                <option value="{{$hobby->name}}" {{Request::get('filter_hobby')==$hobby->name?'selected':''}}>{{$hobby->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="row">
            <h3>All Users</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobbies</th>
                    <th scope="col">Action</th>
                    <th scope="col">Block/Blocked</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                        @if($user->has_blocked()!=2)                 
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->gender}}</td>
                                <td>{{ $user->hobbies?$user->hobbies->implode('name', ', '):''}}</td>
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
