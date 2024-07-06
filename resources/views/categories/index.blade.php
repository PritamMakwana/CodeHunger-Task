@extends('include.admin')

@section('title','Categories')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit & Update Category </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <ul id="update_msgList"></ul>

                    <input type="hidden" id="cate_id" />

                    <div class="form-group mb-3">
                        <label for="">Category Name</label>
                        <input type="text" id="name" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_category">Update</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Edit Modal --}}

    {{-- Delete Modal --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Category Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Confirm to Delete Data ? <p id="deleteing_name"></p>
                    </h4>
                    <input type="hidden" id="deleteing_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_category">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}


    <div class="container py-5">

        <div class="row">
            <div class="col-md-12">

                <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">
                        <h4>Categories</h4>
                        <form action="/categories/import" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".xlsx">
                            <button class="btn btn-primary " type="submit">Import</button>
                        </form>
                        @if ($errors->any())
                        <div class="alert alert-danger mt-1">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success mt-1">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger mt-1">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="display" id="tableCategory">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
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
    </div>


</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
    var table = $('#tableCategory').DataTable();
    fetchCategories();
//1.fetch data
 function fetchCategories(){

    $.ajax({
    type: "GET",
    url: "/fetch-categories",
    dataType: "json",
    success: function (response) {
        $('#tbody').empty();
        table.clear().destroy();
        $.each(response.categories, function (key, item) {
            $('tbody').append('<tr>\
                 <td>' + (key + 1) + '</td>\
                <td>' + item.id + '</td>\
                <td>' + item.name + '</td>\
                <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
            \</tr>');
        });
        table = $('#tableCategory').DataTable();
      }
    });
    }

// 2.edit data
$(document).on('click', '.editbtn', function (e) {
        e.preventDefault();
        var cate_id = $(this).val();
        // alert(cate_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/edit-categories/" + cate_id,
            success: function (response) {
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    // console.log(response.categories.name);
                    $('#name').val(response.categories.name);
                    $('#cate_id').val(cate_id);
                }
            }
        });
        $('.btn-close').find('input').val('');

    });

    $(document).on('click', '.update_category', function (e) {
        e.preventDefault();

        $(this).text('Updating..');
        var id = $('#cate_id').val();
        // alert(id);

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
            url: "/update-categories/" + id,
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
                    $('.update_category').text('Update');
                } else {
                    $('#update_msgList').html("");

                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').find('input').val('');
                    $('.update_category').text('Update');
                    $('#editModal').modal('hide');
                    fetchCategories()
                }
            }
        });

    });

// 3.delete
$(document).on('click', '.deletebtn', function () {
        var cate_id = $(this).val();
        $('#DeleteModal').modal('show');
        $('#deleteing_id').val(cate_id);
        $('#deleteing_name').text('Id : '+cate_id);

    });

    $(document).on('click', '.delete_category', function (e) {
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
            url: "/delete-category/" + id,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('.delete_category').text('Yes Delete');
                } else {
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('.delete_category').text('Yes Delete');
                    $('#DeleteModal').modal('hide');
                    fetchCategories();
                }
            }
        });
    });
});
</script>

@endsection
