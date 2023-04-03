@extends('layouts.admin')

@section('title')
    Update Mail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Mail</h2>
                <p class="dashboard-subtitle">Create New Mail</p>
            </div>

            <!-- Isi Content -->
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('mail.update', $mails->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mail Code</label>
                                                <input type="text" name="mail_code" class="form-control"
                                                    value="{{ $mails->mail_code }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $mails->title }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" name="out_date" class="form-control"
                                                    value="{{ $mails->out_date }}"required>
                                            </div>
                                             <div class="form-group">
                                                <label>Scan File</label>
                                                <input type="file" name="file" class="form-control"
                                                    value="{{ $mails->file }}" >
                                                <input type="hidden" name="file_hidden" class="form-control"
                                                    value="{{ $mails->file }}" >
                                                <small>Kosongkan jika tidak ingin mengganti file</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush
