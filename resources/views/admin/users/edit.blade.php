@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('admin.users')}}" class="btn btn-primary mb-1" >Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (\Session::has('success'))
            <div class="alert alert-success">
              {!! \Session::get('success') !!}
            </div>
         @endif
            <div class="card">
                <div class="card-header">{{$user->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.user.update',['user'=>$user->id ]) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="is_admin">Role</label>
                            <div class="col-md-6 ">
                                <select class=" form-control form-select" name="is_admin" id="is_admin" aria-label="">
                                    <option>Select User Role</option>
                                    <option value="0" {{$user->is_admin == 0 ? 'selected' : '' }}>User</option>
                                    <option value="1" {{$user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('is_admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection