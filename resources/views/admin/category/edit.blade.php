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
