@extends('include.admin')

@section('title','Products')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Add Modal --}}
    <div class="modal fade" id="AddProductModal" tabindex="-1" aria-labelledby="AddProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddProductModalLabel">Add Product Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="save_msgList"></ul>

                    <div class="form-group mb-3">
                        <div class="col-sm-10">
                            <label for="">Select Category</label>
                            <select class="form-control category_name" id="basic-default-name" name="category_name"
                                id="category_name" required>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="name" required class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <input type="file" id="basic-default-phone" class="form-control phone-mask image"
                            aria-describedby="basic-default-phone" name="image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_product">Save</button>
                </div>

            </div>
        </div>
    </div>
    {{-- End Add Modal --}}


    {{-- Delete Modal --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Confirm to Delete Data ? <p id="deleteing_name"></p>
                    </h4>

                    <input type="hidden" id="deleteing_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_product">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End - Delete Modal --}}


    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit & Update Product Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="product_id" />


                    <div class="form-group mb-3">
                        <label for="">Product Name</label>
                        <input type="text" id="name" required class="name form-control ">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_product">Update</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Edn- Edit Modal --}}




    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-baseline ">
        <h5 class="card-header">Products</h5>

        <div>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#AddProductModal">Add Product</button>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div id="success_message"></div>

            <div class="table-responsive text-nowrap" id="products-table">
                <!-- Table will be loaded here -->
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    function fetchProducts(page) {
        $.ajax({
            url: "{{ route('products.ajax') }}?page=" + page,
            success: function(data) {
                $('#products-table').html(data);
            }
        });
    }
    $(document).ready(function() {

        fetchProducts(1);
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchProducts(page);
        });

// add
    $(document).on('click', '.add_product', function (e) {
            e.preventDefault();

            $(this).text('Sending..');

            var formData = new FormData();
            formData.append('category_name', $('.category_name').val());
            formData.append('name', $('.name').val());
            formData.append('image', $('.image')[0].files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/products",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#save_msgList').append('<li>' + err_value + '</li>');
                        });
                        $('.add_product').text('Save');
                    } else {
                        $('#save_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddProductModal').find('input').val('');
                        $('.add_product').text('Save');
                        $('#AddProductModal').modal('hide');
                        fetchProducts(1);
                    }
                }
            });

        });




// edit
    $(document).on('click', '.editbtn', function (e) {
            e.preventDefault();
            var product_id = $(this).val();
            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/edit-products/" + product_id,
                success: function (response) {
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                        $('#name').val(response.products.name);
                        $('#product_id').val(product_id);
                    }
                }
            });
            $('.btn-close').find('input').val('');

        });

        $(document).on('click', '.update_product', function (e) {
            e.preventDefault();

            $(this).text('Updating..');
            var id = $('#product_id').val();

            var data = {
            'name': $('#name').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/update-product/" + id,
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#update_msgList').append('<li>' + err_value +
                                '</li>');
                        });
                        $('.update_product').text('Update');
                    } else {
                        $('#update_msgList').html("");

                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').find('input').val('');
                        $('.update_product').text('Update');
                        $('#editModal').modal('hide');
                        fetchProducts(1);
                    }
                }
            });

        });


        //delete

        $(document).on('click', '.deletebtn', function () {
            var pro_id = $(this).val();
            $('#DeleteModal').modal('show');
            $('#deleteing_id').val(pro_id);
            $('#deleteing_name').text('Id : '+pro_id);
        });


        $(document).on('click', '.delete_product', function (e) {
            e.preventDefault();


            $(this).text('Deleting..');
            var id = $('#deleteing_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/delete-product/" + id,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.delete_product').text('Yes Delete');
                    } else {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.delete_product').text('Yes Delete');
                        $('#DeleteModal').modal('hide');
                        fetchProducts(1);
                    }
                }
            });
        });

    });
</script>
@endsection
