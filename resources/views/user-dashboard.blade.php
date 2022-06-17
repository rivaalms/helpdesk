@extends('layouts/main')
@section('container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid {{-- bg-custom-secondary --}}">
        <div class="container text-center py-5" style="max-width: 800px">
            <div class="py-5">
                <h1 class="display-4 mb-5">User Profile</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-4" style="width:20%;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active text-start" id="v-pills-tickets-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tickets" type="button" role="tab" aria-controls="v-pills-tickets" aria-selected="true">My Tickets</button>
                <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Edit Profile</button>
                <button class="nav-link text-start" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Password</button>
                <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
            </div>

            <div class="tab-content w-100" id="v-pills-tabContent">
                {{-- tickets --}}
                <div class="tab-pane fade show active" id="v-pills-tickets" role="tabpanel" aria-labelledby="v-pills-tickets-tab">
                    <table class="table table-hover align-middle">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $t)
                            <tr>
                                <td class="py-3">#{{$t->id}}</td>
                                {{-- <td><div class="text-truncated">{{$t->subject}}</div></td> --}}
                                <td><a href="/tickets/{{$t->id}}" class="text-reset text-decoration-none faq-links">{{$t->subject}}</a></td>
                                <td>{{$t->category->name}}</td>
                                <td><span class="{{($t->status_id == 1 ? 'status-span-open' : 'status-span-closed')}}">{{$t->status->name}}</span></td>
                                <td>{{$t->created_at->format("d-m-Y H:i")}}</td>
                                {{-- <td><a href="/user-dashboard/{{$t->id}}" class="badge bg-info"><span data-feather="eye"></span></a></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- edit profile --}}
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <form action="/user/profile" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="Name" name="name" value="{{old('name', $user->name)}}">
                            <label for="floatingName">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" value="{{old('email', $user->email)}}">
                            <label for="floatingEmail">Email Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPhone" placeholder="08xxxxxxxxxx" name="phone_number" value="{{old('phone_number', $user->phone_number)}}">
                            <label for="floatingPhone">Phone Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label departement">
                              @foreach ($departement as $u)
                                  <option value="{{$u->id}}">{{$u->name}}</option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Departement</label>
                        </div>
                        <div class="mb-3 text-end">
                            <button type="reset" class="btn btn-custom-secondary">Reset</button>
                            <button type="submit" class="btn btn-custom-primary">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                {{-- password --}}
                <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                    <form action="/user/password" method="post">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingOldPassword" placeholder="Password" name="oldPassword">
                            <label for="floatingOldPassword">Old Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingNewPassword" placeholder="Password" name="password">
                            <label for="floatingNewPassword">New Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="Password" name="confirmPassword">
                            <label for="floatingConfirmPassword">Confirm Password</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-custom-primary">Change Password</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
            </div>
        </div>
    </div>
    
    {{-- table --}}
    <div class="container">
        
    </div>
</div>

@endsection