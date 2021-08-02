@extends('layouts.app')

@section('content')
    <div class="px-2">
        <div class="justify-content-center">
            <div class="">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>

                <div class="table-responsive" style="height: 100vh">
                    <table class="table table-bordered table-striped table-vcenter" id=awards>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="small sticky-top item-id">ID</th>
                                <th scope="col" class="small col sticky-top">Name</th>
                                <th scope="col" class="small col sticky-top">Award Type</th>
                                <th scope="col" class="small col sticky-top">Always Visible</th>
                                <th scope="col" class="small col sticky-top">Award Category</th>
                                <th scope="col" class="small col sticky-top" style="min-width: 250px">Nomination Options</th>
                                <th scope="col" class="small col sticky-top">Order</th>
                                <th scope="col" class="small col sticky-top">Number of Nominations</th>
                                <th scope="col" class="small col sticky-top">Date Starting</th>
                                <th scope="col" class="small col sticky-top">Date Ending</th>
                                <th scope="col" class="small col sticky-top">Actions</th>
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
