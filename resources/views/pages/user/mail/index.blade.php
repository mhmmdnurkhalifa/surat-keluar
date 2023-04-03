@extends('layouts.user')

@section('title')
    My Mails
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Outgoing Mails</h2>
                <p class="dashboard-subtitle">List of Mails</p>
            </div>

            <!-- Isi Content -->
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('mail-create') }}" class="btn btn-primary mb-3">
                                    + Add Mail
                                </a>
                                <div class="table-rensponsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mail Code</th>
                                                <th>Title</th>
                                                <th>Out Date</th>
                                                <th>File</th>
                                                <th>User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 14px"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'mail_code',
                    name: 'mail_code'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'out_date',
                    name: 'out_date',
                },
                {
                    data: 'file',
                    name: 'file'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '10%'
                }
            ],
            order: [
                [0, 'desc']
            ]

        });
        datatable.on('order.dt search.dt', function() {
            let i = 1;

            datatable.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    </script>
@endpush
