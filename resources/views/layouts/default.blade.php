<!DOCTYPE html>
<html>

<head>

    <title>JWT CRUD</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        li.card {
            padding-top: 24px;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-12 d-none d-xl-block ">
                                <div class="card-body p-md-5 text-black">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <h5 class="mb-5 text-uppercase">Welcome <span style="color:green" id="username"></span></h5>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <a href="{{route('home')}}">All Course (Videos)</a>
                                            <a href="{{route('playlist')}}">My Playlist (Courses)</a>

                                            <button type="button" class="btn btn-warning btn-lg ms-2" id="logout">Logout</button>
                                        </div>

                                    </div>



                                    @yield('content')


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        const iframe = document.querySelector('iframe');
        const player = new Vimeo.Player(iframe);

        player.on('play', function() {
            console.log('played the video!');
        });

        player.getVideoTitle().then(function(title) {
            console.log('title:', title);
        });
    </script>

    <script>
        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "/api/me",
                contentType: "application/json; charset=utf-8;",
                headers: {
                    "Authorization": "Bearer " + window.localStorage.getItem('token')
                },
                dataType: "json",
                success: function(data) {
                    if ('status' in data) {
                        window.location.href = "{{ route('welcome')}}";
                    } else {
                        $('#username').text(data.name);
                    }
                },
                error: function(errMsg) {
                    alert(errMsg);
                }
            });





            $("button#logout").click(function() {
                $.ajax({
                    type: "GET",
                    url: "/api/logout",
                    contentType: "application/json; charset=utf-8;",
                    headers: {
                        "Authorization": "Bearer " + window.localStorage.getItem('token')
                    },
                    dataType: "json",
                    success: function(data) {
                        if ('success' in data) {
                            window.location.href = "{{ route('welcome')}}";
                        }
                        if ('status' in data) {
                            alert(data.status);
                        } else {
                            console.log(data);
                        }
                    },
                    error: function(errMsg) {
                        alert(errMsg);
                    }
                });
            });


        });


        function playit() {
            alert();
            // console.log($(this).data('embed-video-link'));
        }
    </script>

</body>

</html>