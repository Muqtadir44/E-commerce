@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('sub-categories.listing')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
							<div class="card-body">
								<div class="row">
                                    <div class="col-md-12">
										<div class="mb-3">
											<label for="name">Category</label>
											<select name="category" id="category" class="form-control">
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)

                                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="email">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="pb-5 pt-3">
							<button class="btn btn-primary">Create</button>
							<a href="{{route('sub-categories.listing')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					<!-- /.card -->
				</section>
@endsection
