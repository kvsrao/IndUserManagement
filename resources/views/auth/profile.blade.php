@extends('layouts.app')

@section('content')
<div class="container">

<h1>Users Profile</h1>
@if(Session::has('pmessage'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('pmessage') }}</p>
    @endif
    <table class="table table-striped">
        <tbody>
                <tr><td>EmpID</td><td>{{ $user->id }}</td></tr>
                <tr><td>Name</td><td>{{ $user->name }}</td></tr>
                <tr><td>Email</td><td>{{ $user->email }}</td></tr>
                <tr><td>Phone</td><td>{{ $user->phone }}</td></tr>
                <tr><td>Address</td><td>{{ $user->address }}</td></tr>
                <tr><td>City</td><td>{{ $user->city }}</td></tr>
                <tr><td>State</td><td>{{ $user->state }}</td></tr>
                @if($user->salary)
                <tr><td>Grass Salary</td><td>{{ @$user->salary->gsalary }}</td></tr>
                <tr><td>PF</td><td>{{ @$user->salary->pf }}</td></tr>
                <tr><td>TDS</td><td>{{ @$user->salary->tds }}</td></tr>
                <tr><td>ESI</td><td>{{ @$user->salary->esi }}</td></tr>
                <tr><td>Net Salary</td><td>{{ @$user->salary->nsalary }}</td></tr>
                @endif
                <tr><td></td><td><a href="{{url('profile-edit/'.$user->id)}}">Edit</a></td></tr>
        </tbody>
    </table>
</div>
@endsection
