<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Datagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/filestyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="formContainer">


        <form class="ajax" id="uploadForm" method="post" action="upload.php">
            <h3>File Upload</h3>
            <div class="form-group"><input class="form-control form-control-user" type="text" id="filename"
                    placeholder="Enter File Name" name="filename">
                <span class="text-danger"></span>
            </div>
            <select class="form-select " aria-label="Default select example" id="company" name="company">
                <option selected value="">Company</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="form-group">
                <label class="col-md-4 control-label" for="filebutton">Attachment</label>
                <div class="col-md-4">
                    <input id="file" name="file" class="input-file" type="file">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
    </div>






    <script>
        $(document).ready(function () {
            $.support.cors = true;
            // On Submit of Upload Form
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/fileupload",
                    type: "POST",
                    data: formData,
                    success: (res) => {
                        alert(res.data);
                        // window.location.href = "/table";
                    }, cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });



    </script>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>