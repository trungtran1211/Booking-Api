<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <form action="/post" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="place_id" class="form-control m-2" placeholder="place_id">
        <input type="room_type_id" name="room_type_id" class="form-control m-2" placeholder="room_type_id">
        <input type="address" name="address" class="form-control m-2" placeholder="address">
        <input type="capacity" name="capacity" class="form-control m-2" placeholder="capacity">
        <input type="room_number" name="room_number" class="form-control m-2" placeholder="room_number">
        <input type="description" name="description" class="form-control m-2" placeholder="description">
        <label class="m-2">Cover Image</label>
        <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="cover_image">

        <label class="m-2">Images</label>
        <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>

        <button type="submit" class="btn btn-danger mt-3 ">Submit</button>
    </form>
</body>
</html>