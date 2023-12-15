$(document).ready(function(){

    // Yajra DataTable --- Start
    var SubCategoryTable = $('#sub-categories-table').DataTable({
        ordering: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: sub_categories_listing,
        columns: [{
            data: 'id',
            name: 'id',
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'slug',
            name: 'slug'
        },
        {
            data: 'status',
            name: 'status',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
        {
            data: 'updated_at',
            name: 'updated_at',
        },
        {
            data: 'action',
            name: 'action'
        }
    ]
    })
    // Yajra DataTable --- End


    // loading sub-category add modal and fetching all catgories
    $(document).on('click','#add',function(e){
        e.preventDefault();
        $.ajax({
            url      :   $(this).data('route'),
            type     :  'get',
            method   :  'get',
            dataType :  'json',
            success  : function(response){
                categories = response.categories;
                var selectElement = $('#categories'); // Store the select element reference
                selectElement.empty();
                selectElement.append('<option value="">Select Category</option>'); // Add "Select Category" option
                categories.forEach(element => {
                    $('#categories').append(`<option value="${element['id']}" >${element['name']}</option>`)
                });
            }
        })
        $('#add-modal').modal('show');

        $('#slug').attr('readonly',true)
        $(document).on('blur','#name',function(){
            var name = $('#name').val();
            $('#slug').val(name)
        })
    })

    // adding sub-category --- Start
    $(document).on('click','#add-subCategory',function(e){
        e.preventDefault();

        // client side validation ---
        var flag     = true;
        var category = $('#categories').val();
        var name     = $('#name').val();

        if (category == "" ) {
            $('#categories').addClass('is-invalid');
            flag = false;
        }else{
            $('#categories').removeClass('is-invalid');

        }

        if (name == "") {
            $('#name').addClass('is-invalid');
            flag = false;
        } else {
            $('#name').removeClass('is-invalid');
        }

        if (flag) {
            console.log('form filled');
            $.ajax({
                url    : add_sub_category,
                method : 'get',
                type   : 'get',
                data   :   {
                    _token   : $("[name='_token']").val(),
                    category : $('#categories').val(),
                    name     : $('#name').val(),
                    slug     : $('#slug').val(),
                    notes    : $('#status').val(),
                },
                dataType     : 'json',
                error        : (err) => {
                    console.log(err);
                    if (err.responseJSON.errors.name) {
                        $('#name').addClass('is-invalid');
                        $('#error_name_msg').text(err.responseJSON.errors.name);
                    }
                },
                success : function(response){
                    console.log(response);
                    $('#add-modal').modal('hide');
                    $('#sub-categories-table').DataTable().ajax.reload();
                }
            })
        } else {
            return false;
        }
    })
    // adding sub-category --- End



    // edit sub-category --- Start

    $(document).on('click','#get_sub_category',function(e){
        e.preventDefault();
        // alert('working');
        $('#edit-modal').modal('show');
        $.ajax({
            url : $(this).data('route'),
            type: 'get',
            method: 'get',
            error: (err) => {
                console.log(err)
             },
            success: function(response){
                console.log(response);

            }
        })
    })

    // edit sub-category --- End


        // Delete sub-category --- Start

        $(document).on('click','#delete_sub_category',function(e){
            e.preventDefault();
            alert('delworking');
        })
        
        // Delete sub-category --- End
})
