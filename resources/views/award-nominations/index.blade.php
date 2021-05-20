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

                @if ($items)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id=award-nominations>
                            <thead>
                                <tr>
                                    <th class="small">ID</th>
                                    <th class="small">Team Member Logging the Nomination</th>
                                    <th class="small">Email contact of Team member logging the nomination</th>

                                    @if ($award->options['office_type'] === 'clinic')
                                        <th class="small">Clinic Name</th>
                                        @foreach ($managers as $manager)
                                            <th class="small">{{ $managersLabel[$managerTypes[$manager]] }}</th>
                                        @endforeach
                                    @else
                                        <th class="small">Department Name</th>
                                    @endif

                                    <th class="small">Name of Nominee</th>

                                    @foreach ($nominationCategories as $category)
                                        <th class="small">{{ $category->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id=award-nominations-container>
                                @include('award-nominations/partials/_items')
                            </tbody>
                        </table>
                    </div>

                    <div id="pagination">
                        @include('pagination', [
                            'paginator' => $items,
                            'layout'    => 'vendor.pagination.bootstrap-4',
                            'role'      => 'award-nominations',
                            'container' => 'award-nominations-container',
                        ])
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
