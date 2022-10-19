@extends('layouts.app')

@section('content')
<h1>Users </h1>
<div class="container">
    @if($users->total() > 0)
     <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Admin</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $key => $user )
            <tr class="{{$user->is_admin ? "bg-success text-white":'' }}">
                <th scope="row">{{ ($users->currentPage()-1) * $users->perPage() + $loop->index + 1 }}</th>
                <td >{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('admin.user.edit',['user'=>$user->id ] )}}" class="btn btn-info">Edit</a></td>
            </tr>
            @empty
                <h1>no record found</h1>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
    @else
            <h1>No Record Found!</h1>
    @endif
</div>
   
@endsection
