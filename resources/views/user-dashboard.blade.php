@extends('layouts/main')
@section('container')
<div class="container" style="max-width: 1200px;">
    <div class="container-fluid {{-- bg-custom-secondary --}}">
        <div class="container text-center py-5" style="max-width: 800px">
            <div class="py-5">
                <h1 class="display-4 mb-5">Profil Pengguna</h1>
            </div>
        </div>
    </div>

    <div class="container">
        @if (session()->has('user_success'))
            <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
                {{session('user_success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('password_success'))
            <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
                {{session('password_success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('ticket_success'))
            <div class="alert alert-success alert-dismissible fade show text-start mb-3" role="alert">
                {{session('ticket_success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-4" style="width:20%;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active text-start" id="v-pills-tickets-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tickets" type="button" role="tab" aria-controls="v-pills-tickets" aria-selected="true">Tiket saya</button>
                <button class="nav-link text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Sunting profil</button>
                <button class="nav-link text-start" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Ubah kata sandi</button>
                {{-- <button class="nav-link text-start" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> --}}
            </div>

            <div class="tab-content w-100" id="v-pills-tabContent">
                {{-- tickets --}}
                <div class="tab-pane fade show active" id="v-pills-tickets" role="tabpanel" aria-labelledby="v-pills-tickets-tab">
                    <table class="table table-hover align-middle">
                        <thead class="ticket-table">
                        <tr>
                            <th>@sortablelink('id', 'ID')</th>
                            <th>@sortablelink('subject', 'Subjek')</th>
                            <th>@sortablelink('category_id', 'Kategori')</th>
                            <th>@sortablelink('status_id', 'Status')</th>
                            <th>@sortablelink('created_at', 'Tanggal dibuat')</th>
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
                            <input type="text" class="form-control" id="floatingName" placeholder="Nama" name="name" value="{{old('name', $user->name)}}">
                            <label for="floatingName">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" value="{{old('email', $user->email)}}">
                            <label for="floatingEmail">Email</label>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="telegramUsername" placeholder="Telegram Username" name="telegram_username" value="{{/* old('telegram_username'), */ $user->webhook->username}}">
                                    <label for="telegramUsername">Telegram Username</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPhone" placeholder="08xxxxxxxxxx" name="phone_number" value="{{old('phone_number', $user->phone_number)}}">
                            <label for="floatingPhone">Nomor telepon</label>
                        </div>

                        @if ($user->user_role_id == 1)
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label departement">
                              @foreach ($departement as $u)
                                  <option value="{{$u->id}}">{{$u->name}}</option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Divisi</label>
                        </div>
                        @else
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label departement" disabled>
                                <option value="">{{$user->user_role->name}}</option>
                            </select>
                            <label for="floatingSelect">Divisi</label>
                        </div>
                        @endif
                        <div class="mb-3 text-end">
                            <button type="reset" class="btn btn-custom-secondary">Atur ulang</button>
                            <button type="submit" class="btn btn-custom-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- password --}}
                <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                    <form action="/user/password" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingOldPassword" placeholder="Password" name="oldPassword" required>
                            <label for="floatingOldPassword">Kata sandi lama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingNewPassword" placeholder="Password" name="password" required>
                            <label for="floatingNewPassword">Kata sandi baru</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="Password" name="confirmPassword" required>
                            <label for="floatingConfirmPassword">Konfirmasi kata sandi baru</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-custom-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if (empty(auth()->user()->telegram_chat_id))
    <div class="position-fixed end-0 p-3" style="z-index:11; bottom: 10%!important;">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="transition: .75s">
            <div class="toast-header">
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close me-0" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p>Anda belum mendaftarkan akun Anda melalui Telegram. Silakan melakukan pendaftaran untuk mendapatkan notifikasi mengenai pembaruan tiket Anda melalui Telegram.</p>
                <a target="_blank" href="https://t.me/alms_helpdesk_bot" class="btn btn-sm btn-custom-primary">Daftar Sekarang</a>
            </div>
        </div>  
    </div>
    @endif

</div> 

@endsection