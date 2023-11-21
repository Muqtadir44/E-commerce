@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('sub-categories.create')}}" class="btn btn-primary">New Sub-category</a>
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
                </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
            </div>
        </div>
        <!-- /.card -->
        @include('admin.sub_category.edit')<!-- Update Category Modal -->
    </section>
@endsection
<script src="{{asset('admin-assets/js/modal-scripts/sub-category.js')}}"></script>
