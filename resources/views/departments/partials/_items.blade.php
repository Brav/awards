<div class="tab-pane fade show active" id="departments"
role="tabpanel"
aria-labelledby="departments">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="departments-table">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Manager</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=departments-container>
                @include('departments/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-departments">
        @include('pagination', [
            'paginator' => $items,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'departments',
            'container' => 'departments-container',
        ])
    </div>
</div>

