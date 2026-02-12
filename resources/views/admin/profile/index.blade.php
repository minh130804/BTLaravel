@extends('layout.admin')

@section('title', 'Thông Tin Cá Nhân')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-muted text-center">Quản trị viên</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Ngày tham gia</b> <a class="float-right">{{ $user->created_at->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Google ID</b>
                            <a class="float-right">
                                @if($user->google_id)
                                    <span class="badge badge-success">Đã liên kết</span>
                                @else
                                    <span class="badge badge-secondary">Chưa liên kết</span>
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Facebook ID</b>
                            <a class="float-right">
                                @if($user->facebook_id)
                                    <span class="badge badge-primary">Đã liên kết</span>
                                @else
                                    <span class="badge badge-secondary">Chưa liên kết</span>
                                @endif
                            </a>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Cập nhật thông tin</b></a>
                </div>
            </div>
        </div>
    </div>
@endsection