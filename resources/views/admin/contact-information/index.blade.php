@extends('layouts.app')

@section('content')
<h1>contacts </h1>
<div class="container">

    @if($contacts->total() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact )
            <tr class="{{$contact->is_read ? " ":'table-primary' }}">
                <th scope="row">{{ ($contacts->currentPage()-1) * $contacts->perPage() + $loop->index + 1 }}</th>
                <td >{{$contact->first_name}}</td>
                <td >{{$contact->last_name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($contact->created_at))->diffForHumans() }}</td>
                <td><a href="{{route('admin.contact.view',['contact'=>$contact->id ] )}}" class="btn btn-primary">View  @if ($contact->is_read != 1)<img src="{!!  asset('svg/new.svg') !!}" alt="" srcset=""> </a></td>@endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $contacts->links() }}
    </div>
    @else
    <h1>no record found</h1>
    @endif

</div>
   
@endsection
