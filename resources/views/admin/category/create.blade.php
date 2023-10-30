@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        <form action="" method="POST" id="category-form">
                            @csrf				
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                            <p id="name_msg"></p> 
                                        </div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label>Slug</label>
											<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>	
                                            <p id="slug_msg"></p> 
                                            
                                        </div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label>Status</label>
											{{-- <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">	 --}}
                                            <select name="status" id="status" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
									</div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Category Image</label>
                                            <input type="hidden" name="image_id" id="image_id" >
                                            <div id="image" class="dropzone dz-clickable">
                                                <div class="dz-message needsclick">    
                                                    <br>Drop files here or click to upload.<br><br>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>								
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection
@section('custom_js')
<script>
    $('#category-form').submit(function(e){
        e.preventDefault();
        var formdata = $(this);
        $('button[type=submit]').prop('disabled',true);
        $.ajax({
            url: '{{route('categories.store')}}',
            type: 'POST',
            data: formdata.serializeArray(),
            dataType: 'json',
            success: function(response){
        $('button[type=submit]').prop('disabled',false);
                if (response['status'] == true) {
                    window.location.href="{{route('categories.index')}}";
                } else {
                    
                    var errors = response['errors'];
                    if (errors['name']) {
                        $('#name').addClass('is-invalid')
                        .siblings('p').addClass('invalid-feedback')
                        .html(errors['name']);
                    }else{
                        $('#name').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback')
                        .html("");
                    }

                    if (errors['slug']) {
                        $('#slug').addClass('is-invalid')
                        .siblings('p').addClass('invalid-feedback')
                        .html(errors['slug']);
                    }else{
                        $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback')
                        .html("");
                    }
                }

            }, error: function(jqXHR, exception){
                console.log('something went wrong');
            }
        })
    })

    $('#name').change(function(){
        var element = $(this);
        $('button[type=submit]').prop('disabled',true);

            $.ajax({
            url: '{{route('getSlug')}}',
            type: 'GET',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $('button[type=submit]').prop('disabled',false);
                if (response['status'] == true) {
                    $("#slug").val(response['slug']);
                }
            } 
        });
    });

    Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        //console.log(response)
    }
});
</script>
@endsection