@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Categories</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('categories.create')}}" class="btn btn-primary">New Category</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        @include('admin.message')
						<div class="card">
                           
							<div class="card-body table-responsive">	
                               						
								{{-- <table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Name</th>
											<th>Slug</th>
											<th width="100">Status</th>
											<th width="100">Action</th>
										</tr>
									</thead>
									<tbody>
                                        @if ($categories->isNotEmpty())
                                           @foreach ($categories as $category)
                                               
                                           <tr>
                                               <td>{{$category->id}}</td>
                                               <td>{{$category->name}}</td>
                                               <td>{{$category->slug}}</td>
                                               <td>
                                                @if ($category->status == 'Active')                                                    
                                                    <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
													    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
												    </svg>
                                                @endif
                                               </td>
                                               <td>
                                                   <a href="#">
                                                       <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                           <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                       </svg>
                                                   </a>
                                                   <a href="#" class="text-danger w-4 h-4 mr-1">
                                                       <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                           <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                         </svg>
                                                   </a>
                                               </td>
                                           </tr>
                                           @endforeach 
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-danger">
                                                    No Record Found
                                                </td>
                                            </tr>
                                        @endif
									</tbody>
								</table>										 --}}
                                {{-- {{$dataTable->table()}} --}}
                                {!! $dataTable->table(['class' => 'table table-hover text-nowrap table-striped']) !!}
							</div>
							{{-- <div class="card-footer clearfix">
                                {{$categories->links('pagination::bootstrap-5')}}
								
							</div> --}}
						</div>
                        <div class="row">
                            <div class="col">
                            </div>
                        </div>
					</div>
					<!-- /.card -->
                    <div class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="show_all_products">
                                <p id="msg"></p>
                                <form action="{{route('categories.update')}}" method="POST" id="update_category_form">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="hidden" name="category_id" id="category_id" value="">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="category_name" placeholder="Name">
                                    </div>
                                      <div class="mb-3">
                                        <label  class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">    
                                    </div>
                                      <div class="mb-3">
                                        <label  class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inative</option>
                                        </select>    
                                    </div>
                                      <div class="text-center">
                                        <button type="submit" id="update_category_btn" class="btn btn-primary px-5">Update Category</button>
                                      </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
				</section>
				<!-- /.content -->

{{-- Update Category Modal --}}
@endsection
@section('custom_js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

{{$dataTable->scripts(attributes:['type' => 'module'])}}
<script>
    $(document).on('click','.edit-btn',function(e){
        e.preventDefault();
        var category_id = $(this).attr('id');
        $.ajax({
            url: '{{route('categories.edit')}}',
            type: 'GET',
            data: {
                id:category_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response){
                console.log(response);
                $('#category_id').val(response.id);
                $('#category_name').val(response.name);
                $('#slug').val(response.slug);
                $('#status').val(response.status);
            }
        })
    })

    $('#update_category_form').on('submit',function(e){
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: '{{route('categories.update')}}',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response){
                console.log(response);
                
            }
        })



    })
</script>
@endsection