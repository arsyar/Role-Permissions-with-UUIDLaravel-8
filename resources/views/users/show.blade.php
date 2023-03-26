@extends('layouts.app')
@section('title')
    Profile User
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile User</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('users.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        <div class="section-body">
            <h2 class="section-title">Hi, {{ $users->name }}</h2>
            <p class="section-lead">
                information about User on this page.
            </p>
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('img/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Create</div>
                                    <div class="profile-widget-item-value">{{ $users->created_at->format('d-m-Y') }} | {{ $users->created_at->format('H:i') }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Update</div>
                                    <div class="profile-widget-item-value">{{ $users->updated_at->format('d-m-Y') }} | {{ $users->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $users->name }}
                                <div class="text-muted d-inline font-weight-normal">
                                    @if (!empty($users->getRoleNames()))
                                        @foreach ($users->getRoleNames() as $role_name)
                                            <div class="slash"></div><b>{{ $role_name }}</b>
                                        @endforeach
                                    @endif
                                </div>
                                <p><i class="fa fa-envelope"> {{ $users->email }}</i></p>
                            </div>
                            {{ $users->name }} is a superhero name in <b>Indonesia</b>, especially in my family. He is not a
                            fictional character but an original hero in my family, a hero for his children and for his wife.
                            So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John
                                Doe'</b>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
