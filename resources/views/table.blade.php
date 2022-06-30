<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

</head>

<body>


    <!-- Main Container -->
    <div class="tableContainer">
        <div class="logoutDiv">

            <div class="subLogoutDiv">
                <img src="../img/datagenLogo.png" alt="">
                <h4>Datagen File System</h4>
            </div>


        </div>
        <div class="bodyContainer">
            <div class="leftNav">
                <ul>
                    <li id="upbtn"><i class="fa-solid fa-upload icon-2x"></i>
                        <h5>Uploaded Files</h5>
                    </li>
                    <li id="regbtn"><i class="fa-solid fa-users icon-2x"></i>
                        <h5>Registered User</h5>
                    </li>
                    <li id="logout"><i class="fa-solid fa-arrow-right-from-bracket icon-2x"></i>
                        <h5>Log Out</h5>
                    </li>
                </ul>
            </div>
            <div class="tableCont">
                <div class="tableContainer2" id="fileTbl">
                    <h2>List of Files</h2>
                    <table id="table" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FILENAME</th>
                                <th>COMPANY</th>
                                <th>USER WHO UPLOADED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td>{{$file->id}}</td>
                                <td>{{$file->filename}}</td>
                                <td>{{$file->dataflow}}</td>
                                <td>{{$file->user_ID_FK}}</td>
                                <td>
                                    <a href="{{url('/table/download'.$file->fileDIR)}}"
                                        class="sbmit download">Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tableContainer2" id="registeredUserTbl">
                    <h2>Registered Users</h2>
                    <table id="table2" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>USERNAME</th>
                                <th>COMPANY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->company}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>











    </div>


    <script>
        $(document).ready(function () {
            $("#registeredUserTbl").hide();
            $("#logout").click(() => {

                //Log - out
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/tableLogOut",
                    type: "GET",
                    data: {},
                    success: (res) => {
                        alert(res.data);
                        if (res.boolean) {
                            window.location.href = "/";
                        }
                        else {
                            window.location.href = "/table";
                        }
                    }, cache: false,
                    contentType: false,
                    processData: false
                });
            })
            $("#upbtn").on('click', () => {
                $("#fileTbl").show();
                $("#registeredUserTbl").hide();
            })

            $("#regbtn").on('click', () => {
                $("#registeredUserTbl").show();
                $("#fileTbl").hide();
            })
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

</body>

</html>
<script>
    $(document).ready(function () {
        $('#table').DataTable();
        $('#table2').DataTable();
    });
</script>