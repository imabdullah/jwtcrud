<!DOCTYPE html>
<html>

<head>

    <title>JWT CRUD</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block login">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Login!</h3>
                                    <div class="alert alert-danger" style="display: none;" role="alert" id="login-error"></div>
                                    <div>
                                        <div class="col-md-12 mb-12">
                                            <div class="form-outline">
                                                <input type="email" id="form3Example1n" name="email" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1n">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-12">
                                            <div class="form-outline">
                                                <input type="password" id="form3Example1m1" name="password" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1m1">Password</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="button" class="btn btn-warning btn-lg ms-2" id="login">Login</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 register">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Register!</h3>
                                    <div class="alert alert-danger" style="display: none;" role="alert" id="register-error">
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-12">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example1m" name="full_name" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1m">Full name</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="col-md-12 mb-12">
                                            <div class="form-outline">
                                                <input type="email" id="form3Example1n" name="email" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1n">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-12">
                                            <div class="form-outline">
                                                <input type="password" id="form3Example1m1" name="password"  class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1m1">Password</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="button" class="btn btn-warning btn-lg ms-2" id="register">Register</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("button#register").click(function() {
                data = { name:  $(".register input[name=full_name]").val(),email:  $(".register input[name=email]").val(), password: $(".register input[name=password]").val() };
                $(".alert").hide();
                $.ajax({
                    type: "POST",
                    url: "/api/register",
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data){
                        if ('success' in data){
                            alert(data.message);
                        }
                        else{
                            errors = "<ul>";
                            if ('email' in data.error)
                                errors = errors+'<li>'+ data.error.email[0]+"</li>";
                            if ('password' in data.error)
                                errors = errors+'<li>'+ data.error.password[0]+"</li>";
                            if ('name' in data.error)
                                errors = errors+'<li>'+data.error.name[0]+"</li>";
                            errors = errors+"</ul>";
                            $("#register-error").show();
                            $("#register-error").html(errors);
                            alert(errors);
                        }
                        
                    },
                    error: function(errMsg) {
                        alert(errMsg);

                    }
                });
                
            });


            $("button#login").click(function() {
                data = { email:  $(".login input[name=email]").val(), password: $(".login input[name=password]").val() };
                console.log(data);
                $(".alert").hide();
                $.ajax({
                    type: "POST",
                    url: "/api/login",
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data){
                        if ('success' in data){
                            window.localStorage.setItem('token', data.token);
                            window.location.href = "{{ route('home')}}";
                        }
                        else{
                            errors = "<ul>";
                            if ('email' in data.error)
                                errors = errors+'<li>'+ data.error.email[0]+"</li>";
                            if ('password' in data.error)
                                errors = errors+'<li>'+ data.error.password[0]+"</li>";
                            if ('name' in data.error)
                                errors = errors+'<li>'+data.error.name[0]+"</li>";
                            errors = errors+"</ul>";
                            $("#login-error").show();
                            $("#login-error").html(errors);
                            alert(errors);
                        }
                        
                    },
                    error: function(errMsg) {
                        alert(errMsg);

                    }
                });
                
            });
        });
    </script>

</body>

</html>