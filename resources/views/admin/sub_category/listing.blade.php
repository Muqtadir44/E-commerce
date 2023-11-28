@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-route="{{route('getCategories')}}" id="add" class="btn btn-primary">New Sub-category</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="sub-categories-table" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
            </div>
        </div>
        <!-- /.card -->
        @include('admin.sub_category.create')<!-- Create Category Modal -->
        @include('admin.sub_category.edit')<!-- Update Category Modal -->
    </section>
    @endsection
@section('custom_js')
<script>

    var sub_categories_listing   = '{{route('sub-categories.listing')}}'
    var add_sub_category         = '{{route('sub-categories.add')}}'
    var sub_categories_edit      = '{{route('sub-categories.update')}}'
</script>
<script src="{{asset('admin-assets/js/modal-scripts/sub-category.js')}}"></script>
@endsection
