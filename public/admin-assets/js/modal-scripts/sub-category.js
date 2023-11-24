$(document).ready(function(){

    var SubCategoryTable = $('#sub-categories-table').DataTable({
        ordering: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: sub_categories_listing,
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'slug',
            name: 'slug'
        },
        {
            data: 'created_at',
            name: 'created_at'
        }
    ]
    })

    // loading sub-category add modal and fetching all catgories
    $(document).on('click','#add',function(e){
        e.preventDefault();
        $.ajax({
            url:       $(this).data('route'),
            type:      'get',
            method:    'get',
            dataType:  'json',
            success: function(response){
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

    // adding sub-category
    $(document).on('click','#add-subCategory',function(e){
        e.preventDefault();

        // client side validation ---
        var flag     = true;
        var category = $('#categories').val();
        var name     = $('#name').val();

        if (category == "" && name == "" ) {
            flag = false;
        }

        if (flag) {
            console.log('form filled');
        } else {
            return false;
        }
    })
})
