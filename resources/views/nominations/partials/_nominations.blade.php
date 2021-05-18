<div class="tab-pane fade show active" id="nominations"
role="tabpanel"
aria-labelledby="nominations">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="nominations-table">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Category</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=nominations-container>
                @include('nominations/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-nominations">
        @include('pagination', [
            'paginator' => $nominations,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'nominations',
            'container' => 'nominations-container',
        ])
    </div>
</div>

