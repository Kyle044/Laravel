<!doctype html>
<html lang="en">
@include('components.head')

<body>
    <!-- Main Container -->
    <div class="mainLogin">
        <!-- White Card -->
        <div class="loginCard">
            <!-- Left side of Card -->
            <div class="welcomeCard">
                <!-- Logo -->
                <img src="/img/datagenLogo.png" alt="">
                <!-- --- -->
                <h3>Welcome to Datagen</h3>
                <p>Sign in to continue access</p>
            </div>
            <!-- Right side of Card -->
            <form class="inputCard" id="loginForm">

                <!-- <ul>
                    Example of select table
                    @foreach($users as $user)
                    <li>{{$user->firstname}}</li>
                    @endforeach

                </ul> -->

                <h3>Sign In</h3>
                <div class="form-group"><input class="form-control form-control-user" type="text" id="username"
                        placeholder="Enter Username" name="username">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group"><input class="form-control form-control-user" type="password" id="password"
                        placeholder="Enter Password" name="password">
                    <span class="text-danger"></span>
                </div>
                <button type="submit" class="sbmit">Submit</button>
            </form>
        </div>








        <!-- <div class="footerContainer">
            <div>
                <h1>Some Links</h1>
                <ul>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">Cookies Policy</a></li>
                    <li><a href="">Terms of Service</a></li>
                </ul>
            </div>

            <div>
                <form class="contactForm">
                    <div class="nameEmail">
                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email</label>
                            <div class="col-8">
                                <input id="email" name="email" type="text" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-4 col-form-label">Name</label>
                            <div class="col-8">
                                <input id="name" name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message" class="col-4 col-form-label">Message</label>
                        <div class="col-8">
                            <textarea id="message" name="message" cols="40" rows="5" class="form-control"></textarea>
                        </div>
                    </div>


                </form>
            </div>
            <div></div>
        </div> -->





    </div>

    <script>
        $(document).ready(function () {
            // On Submit of Login Form
            $("#loginForm").submit(function (e) {
                var username = $("#username").val();
                var password = $("#password").val();
                var formData = new FormData(this);
                if (username && password) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    $.ajax({
                        url: "/",
                        type: "POST",
                        data: formData,
                        success: (res) => {
                            alert(res.msg);
                            if (res.data) {


                                console.log(res.user);
                                window.location.href = "/table";

                            } else {
                                window.location.href = "/";
                            }
                        }, cache: false,
                        contentType: false,
                        processData: false
                    });


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