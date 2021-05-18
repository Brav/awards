@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block-content">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-{{ session('status.type') }}" role="alert">
                        {{ session('status.message') }}
                    </div>
                @endif
            </div>

            <div class="row col-md-12">

                <div class="float-right">
                    <a href="{{ route('departments.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="location"
                            data-attr="{{ route('departments.create') }}"
                            class="btn btn-primary my-2">Create Departments</a>
                </div>

            </div>

            <div class="tab-content" id="myTabContent">
                @include('departments/partials/_items')
            </div>
        </div>
    </div>
@endsection
