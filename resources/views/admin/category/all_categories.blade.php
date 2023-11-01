@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) start -->
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
<!-- Content Header (Page header) end -->

	<!-- Main content  section start-->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <div class="card-body table-responsive">	               						
            {!! $dataTable->table(['class' => 'table table-hover text-nowrap']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
        </div>
    </div>
    <!-- /.card -->
    {{-- Update Category Modal --}}
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
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>
                        <div class="mb-3">
                        <label  class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" readonly>    
                    </div>
                        <div class="mb-3">
                        <label  class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inative</option>
                        </select>    
                    </div>
                    <div class="mb-3">
                        <label for="">Category Image</label>
                        <div id="category_image" class="mb-3">
                        </div>
                            <input type="hidden" name="image_id" id="image_id" >
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">    
                                    <br>Drop files here or click to upload.<br><br>                                            
                                </div>
                            </div>
                    </div>
                        <div class="text-center">
                        <button type="submit" id="update_category_btn" class="btn btn-primary px-5">Update Category</button>
                        </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{-- Update Category Modal --}}
</section>
@endsection
	<!-- Main content  section end-->

{{-- Custom JS - AJAX --}}
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
                    $('#name').val(response.name);
                    $('#slug').val(response.slug);
                    if (!response.image == "") {
                        $('#category_image').html(`<img src='{{asset('uploads/category/${response.image}')}}' width='100px' class='mt-2 img-fluid rounded'>`)
                    }else{

                        $('#category_image').html(``);
                    }
                    $('#status').val(response.status);
                }
            })
        });

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

    

        $('#update_category_form').on('submit',function(e){
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: '{{route('categories.update')}}',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data);
                    window.location.href = "{{route('categories.index')}}";
                    // table_reload();

                }
            })
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

        function delete_category(id){
        // alert(id);
        var id = id;
        var url    = "{{route('categories.delete','ID')}}";
        var newurl = url.replace("ID",id);
        if (confirm("Are You Sure you want to delete")) {
            $.ajax({
                url: newurl,
                type: 'delete',
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    window.location.href = "{{route('categories.index')}}"; 
                }
            });
        }
        }
    </script>
@endsection