@extends('layouts.app')

@section('content')
<div class="container">

<h1>List Of Users</h1>
@if(Session::has('pmessage'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('pmessage') }}</p>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Salary</th>
                <th>Options</th>
                <th>Delete</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr id="rowId-{{$user->id}}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->state }}</td>
                <td>{{ @$user->salary->nsalary }}</td>
                <td><a href="{{url('salary-add/'.$user->id)}}">Add/Edit</a></td>
                <td><button onclick="deleteUser(event, {{$user->id}})" id="trash{{$user->id}}" data-id="{{$user->id}}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                </svg></button></td>
                <td><input type="checkbox" id="selectedIds-{{$user->id}}" name="selectedIds[]" value="{{$user->id}}" onclick="changeStatus(event, {{$user->id}})" <?php if($user->status == '1') { echo  "checked"; } ?> ></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection

<script>

function changeStatus(e,val) {
    // e.preventDefault();
    $.ajax({
        url: "{{url('/api/status_change')}}/"+val,
        method: "post",
        success: function(data) {
            console.log(data);
            if(data.status == "success") {
                alert("User Active Status Changed to "+data.active);
            }
        },
        error: function(data){
            alert(data.msg);
            console.log(data);
        }
    });
}

function deleteUser(e,val) {
    e.preventDefault();
    if(confirm("Are you sure want to delete?")){
        $.ajax({
            url: "{{url('/api/remove_user')}}/"+val,
            method: "post",
            success: function(data) {
                console.log(data);
                if(data.status == "success") {
                    $('#rowId-'+val).hide();
                    alert("User Removed Successfuly");
                }
            },
            error: function(data){
                alert(data.msg);
                console.log(data);
            }
        });
    }
}


</script>