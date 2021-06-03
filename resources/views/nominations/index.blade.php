@extends('layouts.app')

@section('content')
    <div class="content" style="padding-top: 150px; padding-bottom: 150px">
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
                    <a href="{{ route('nominations.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="location"
                            data-attr="{{ route('nominations.create') }}"
                            class="btn btn-primary my-2">Create Nomination</a>
                </div>

                <div class="float-right">
                    <a href="{{ route('nominations-category.create') }}"
                            role="bigModal"
                            data-toggle="modal"
                            data-target="#bigModal"
                            data-table="location"
                            data-attr="{{ route('nominations-category.create') }}"
                            class="btn btn-primary my-2">Create Nomination Category</a>
                </div>

            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <a class="nav-link active"
                    id="nominations-tab"
                    data-toggle="tab"
                    href="#nominations"
                    role="tab"
                    aria-controls="nominations"
                    aria-selected="true">Nominations</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link"
                    id="nomination-categories-tab"
                    data-toggle="tab"
                    href="#nomination-categories"
                    role="tab"
                    aria-controls="nomination-categories"
                    aria-selected="false">Nomination Categories</a>
                </li>

            </ul>

            <div class="tab-content" id="myTabContent">
                @include('nominations-category/partials/_categories')
                @include('nominations/partials/_nominations')
            </div>
        </div>
    </div>
@endsection
