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
                {!! $dataTable->table(['class' => 'table table-hover text-nowrap w-100']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
        </div>
    </div>
    <!-- /.card -->
    @include('admin.category.edit')<!-- Update Category Modal -->
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
                    $('#edit_category').modal('hide');
                    console.log(data);
                    Swal.fire({
                        title: "Updated",
                        text: "Category Updated Successfully",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                        });
                    // window.location.href = "{{route('categories.index')}}";
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
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: newurl,
                type: 'delete',
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                            // window.location.href = "{{route('categories.index')}}";
                        }
                    })
                }
            });

        }
        });
        }
    </script>
@endsection
