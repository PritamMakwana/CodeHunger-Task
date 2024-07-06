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
                        <input type="text" id="nameupdate" required class="nameupdate form-control ">
                    </div>
                    <div class="form-group mb-3">
                        <div class="col-sm-10">
                            <label for="">Select Category</label>
                            <select class="form-control category_name_editdt" name="category_name_editdt"
                                id="category_name_editdt" required>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Image</label>
                        <input type="file" id="imageupdate" class="form-control image" name="imageupdate" />
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
            <div class="table-responsive text-nowrap">
                <table class="display" id="tableProduct">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
    var table = $('#tableProduct').DataTable();
    fetchProducts();
//1.fetch data
 function fetchProducts(){

    $.ajax({
    type: "GET",
    url: "/products/ajax",
    dataType: "json",
    success: function (response) {
        $('#tbody').empty();
        table.clear().destroy();
        $.each(response.products, function (key, item) {
                    var imageUrl = item.image ? '{{ Storage::url('products/') }}' + item.image : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                    $('#tbody').append('<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + item.id + '</td>\
                        <td>' + item.category.name + '</td>\
                        <td>' + item.name + '</td>\
                        <td><img src="' + imageUrl + '" height="50"></td>\
                        <td><button type="button" value="' + item.id + '" class="btn-sm btn-primary editbtn">Edit</button></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn">Delete</button></td>\
                    </tr>');
                });
        table = $('#tableProduct').DataTable();
      }
    });
    }



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
                        fetchProducts();
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
                   // console.log(response);
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                         $('#nameupdate').val(response.products.name);
                         $('#old_image').val(response.products.image);
                         $('#category_name_editdt').val(response.products.category_name);
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

            // var data = {
            // 'name': $('#name').val(),
            // }

            var formData = new FormData();
            formData.append('name', $('#nameupdate').val());
            formData.append('category', $('#category_name_editdt').val());

            var imageFile = $('#imageupdate')[0].files[0];
            if (imageFile) {
             formData.append('image', imageFile);
            }

            // formData.forEach((value, key) => {
            // console.log(key + ": " + value);
            // });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/update-product/" + id,
                data: formData,
                processData: false,
                contentType: false,
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
                        fetchProducts();
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
                        fetchProducts();
                    }
                }
            });
        });

    });
</script>
@endsection
