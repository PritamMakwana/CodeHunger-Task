<table class="table">
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
    <tbody>
        @php($i = 0)
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->name }}</td>
            <td>
                @if(!$product->image)
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" height="50">
                @else

                <img src="{{ Storage::url('products/'.$product->image) }}" height="50">
                @endif
            </td>
            <td><button type="button" value="{{$product->id}}" class="btn-sm btn-primary editbtn btn-sm">Edit</button>
            </td>
            <td><button type="button" value="{{$product->id}}" class="btn btn-danger deletebtn btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2">
    {!! $products->links() !!}
</div>
