@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('admin.contacts.info')}}" class="btn btn-primary mb-1" >Back</a>
    <div class="card" style="width: 100%">
        <div class="card-body">
          <h5 class="card-title"> <b>Name: </b>{{$contact->first_name. ' '. $contact->last_name  }}</h5>
          <h6 class="card-subtitle mb-2 "> <b>Email:</b> {{$contact->email}} </h6>
          <h6 class="card-subtitle mb-2 "> <b>Phone:</b> {{$contact->phone}} </h6>
          <h6 class="card-subtitle mb-2 "> <b>Date:</b> {{ \Carbon\Carbon::parse($contact->created_at)->format('d-m-Y') }} </h6>
          <p class="card-text"> <b> Message:</b> {{$contact->message}}</p>
        </div>
      </div>
</div>
  @endsection