@extends('layouts.app')

@section('content')
<div class="container">
    @if($userActions)
        <div class="row">
            <h3>All Users' Log</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Created by</th>
                    <th scope="col">Created for</th>
                    <th scope="col">Action</th>
                    <th scope="col">Created date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userActions as $key=>$user)      
                        @php
                            
                        @endphp          
                            <tr>
                                <td>{{ \App\User::find($user->created_by)->name??''}}</td>
                                <td>{{ \App\User::find($user->created_for)->name??''}}</td>
                                <td>{{ $user->action}}</td>
                                <td>{{ $user->created_at}}</td>                              
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
