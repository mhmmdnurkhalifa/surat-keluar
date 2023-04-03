@extends('layouts.admin')

@section('title')
    Mail Dashboard
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">This is Mail Administrator</p>
            </div>

            <!-- Isi Content -->
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Users</div>
                                <div class="dashboard-card-subtitle">{{ number_format($users->count()) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Out Mails</div>
                                <div class="dashboard-card-subtitle">{{ number_format($mails->count()) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                @php
                                    $TotalUpload = App\Models\Mail::where('users_id', Auth::user()->id)
                                        ->select(DB::raw('users_id'))
                                        ->groupBy(['id'])
                                        ->get()
                                        ->count();
                                @endphp
                                <div class="dashboard-card-title">Total Uploads</div>
                                <div class="dashboard-card-subtitle">{{ $TotalUpload }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
