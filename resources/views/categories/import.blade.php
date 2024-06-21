<!DOCTYPE html>
<html>
<head>
    <title>Import Categories</title>
</head>
<body>
    <h2>Import Categories</h2>
    <form action="/categories/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Import</button>
    </form>
</body>
</html>
