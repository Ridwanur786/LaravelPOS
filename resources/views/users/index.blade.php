@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="d-flex justify-content-start">All Users</h4>
                    <a href="#" class="d-flex justify-content-end btn btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="bi bi-person-plus me-1"></i>Add User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                <thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td>@if($user->isAdmin==1)
                                            Admin
                                            @else
                                            Cashire
                                            @endif</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <button class="btn btn-secondary btn-sm me-md-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft{{$user->id}}"><i class="bi bi-pencil"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop{{$user->id}}"><i class="bi bi-trash2"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft{{$user->id}}" aria-labelledby="offcanvasRightLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasRightLabel">User Edit</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form class="row g-3" action="{{route('users.update',$user->id)}}" method="post">
                                                @csrf
                                                @method('put')

                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Name</label>
                                                    <input type="text" name="name" value="{{$user->name}}" class="form-control form-control-sm" id="inputEmail4">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Email</label>
                                                    <input type="email" name="email" value="{{$user->email}}" class="form-control form-control-sm" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Password</label>
                                                    <input type="password" name="password" value="{{$user->password}}" readonly class="form-control form-control-sm" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label"> Confirm Password</label>
                                                    <input type="password" name="confirm_password" value="{{$user->confirm_password}}" class="form-control form-control-sm" id="inputPassword4">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Address</label>
                                                    <input type="text" name="address" value="{{$user->address}}" class="form-control form-control-sm" id="inputAddress" placeholder="1234 Main St">
                                                </div>
                                                <div class="col-6">
                                                    <label for="inputAddress2" class="form-label">Phone</label>
                                                    <input type="text" name="phone_number" value="{{$user->phone_number}}" class="form-control form-control-sm" id="inputAddress2" placeholder="phone number">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label">City</label>
                                                    <input type="text" name="city" value="{{$user->city}}" class="form-control form-control-sm" id="inputCity">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputState" class="form-label">Role</label>
                                                    <select id="inputState" name="isAdmin" class="form-select form-select-sm">
                                                        <option selected>Choose...</option>
                                                        <option value="1" @if($user->isAdmin == 1)
                                                            selected
                                                            @endif>Admin</option>
                                                        <option value="2" @if($user->isAdmin == 2)
                                                            selected
                                                            @endif>Cashire</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm mt-2">update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop{{$user->id}}" aria-labelledby="offcanvasTopLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasTopLabel">User Delete</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form class="row g-3" action="{{route('users.destroy',$user->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <h4>Are You Sure you want to delete ? </h4>
                                                <div class="col-12">
                                                    <button type="button" data-bs-dismiss="offcanvas" class="btn btn-outline-secondary btn-sm mt-2">Cancel</button>
                                                    <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">Search Users</div>
                <div class="card-body">
                    <form action="">
                        <input type="search" name="userSearch" id="search" class="form-control" placeholder="search user">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button> --}}

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">User Registration</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="row g-3" action="{{route('users.store')}}" method="post">
                @csrf
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" id="inputEmail4">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label"> Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control form-control-sm" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control form-control-sm" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-6">
                    <label for="inputAddress2" class="form-label">Phone</label>
                    <input type="text" name="phone_number" class="form-control form-control-sm" id="inputAddress2" placeholder="phone number">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" name="city" class="form-control form-control-sm" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Role</label>
                    <select id="inputState" name="isAdmin" class="form-select form-select-sm">
                        <option selected>Choose...</option>
                        <option value="1">Admin</option>
                        <option value="2">Cashire</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    @endsection
