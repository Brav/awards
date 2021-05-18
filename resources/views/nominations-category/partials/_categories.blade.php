<div class="tab-pane fade" id="nomination-categories"
role="tabpanel"
aria-labelledby="nomination-categories">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="nomination-categories-table">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=categories-container>
                @include('nominations-category/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-categories">
        @include('pagination', [
            'paginator' => $categories,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'nomination-categories',
            'container' => 'nomination-categories-container',
        ])
    </div>
</div>

