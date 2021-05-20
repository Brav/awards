@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter" id=awards>
                        <thead>
                            <tr>
                                <th class="small">ID</th>
                                <th class="small">Name</th>
                                <th class="small">Award Type</th>
                                <th class="small">Always Visible</th>
                                <th class="small">Office Type</th>
                                <th class="small">Nomination Options</th>
                                <th class="small">Order</th>
                                <th class="small">Number of Nominations</th>
                                <th class="small">Actions</th>
                            </tr>
                        </thead>
                        <tbody id=awards-container>
                            @include('awards/partials/_items')
                        </tbody>
                    </table>
                </div>

                <div id="pagination">
                    @include('pagination', [
                        'paginator' => $items,
                        'layout'    => 'vendor.pagination.bootstrap-4',
                        'role'      => 'awards',
                        'container' => 'awards-container',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
