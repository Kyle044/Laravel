<!doctype html>
<html lang="en">

@include('components.head')

<body>
    <!-- Main Container -->
    <div class="mainLogin">
        <!-- White Card -->
        <form class="loginCard regCard " id="registerForm" name="registerForm">

            <!-- Logo -->
            <img src="../img/datagenLogo.png" alt="">
            <!-- --- -->
            <h3>Registration</h3>
            <!-- Left side of Card -->
            <div class="registerCard">
                <div class="welcomeCard inputCard btm">


                    <div class="form-group"><input class="form-control form-control-user" type="text" id="fname"
                            placeholder="Enter First Name" name="fname">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group"><input class="form-control form-control-user" type="text" id="lname"
                            placeholder="Enter Last Name" name="lname">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group"><input class="form-control form-control-user" type="text" id="username"
                            placeholder="Enter Username" name="username">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <!-- Right side of Card -->
                <div class="inputCard mt">

                    <div class="form-group"><input class="form-control form-control-user" type="text" id="company"
                            placeholder="Enter Company" name="company">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group"><input class="form-control form-control-user" type="password" id="password"
                            placeholder="Enter Password" name="password">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group"><input class="form-control form-control-user" type="password" id="confirm"
                            placeholder="Confirm Password" name="confirm">
                        <span class="text-danger"></span>
                    </div>

                </div>
            </div>
            <button type="submit" class="sbmit">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            // On Submit of Register Form
            $("#registerForm").submit(function (e) {
                var username = $("#username").val();
                var password = $("#password").val();
                var confirm = $("#confirm").val();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var formData = new FormData(this);
                if (username && password && confirm && fname && lname) {
                    if (confirm != password) {
                        alert("The Password does not match.");
                    }
                    else {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/register",
                            type: "POST",
                            data: formData,
                            success: (res) => {
                                if (res.boolean) {
                                    alert(res.data);
                                    window.location.href = "/";
                                } else {
                                    alert(res.data);
                                    window.location.href = "/register";
                                }
                            }, cache: false,
                            contentType: false,
                            processData: false
                        });

                    }
                }
                else {
                    alert("Please input the missing field.")
                }
                e.preventDefault();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>