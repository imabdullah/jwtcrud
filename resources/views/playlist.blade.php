@extends('layouts.default')
@section('content')

<div class="videos">
    loading...
</div>





<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "/api/course",
            contentType: "application/json; charset=utf-8;",
            headers: {
                "Authorization": "Bearer " + window.localStorage.getItem('token')
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                content = "<ul>";
                var ads = "";
                $.each(data, function(i, data) {

                    ads = "<iframe src='" + data.link + "' width='640' height='360'></iframe>";
                    content = content + "<li class='card' url='" + data.link + "'> " + ads + "<h5>" + data.name + "</h5><p>" + data.created_at + "</p></li>";
                });
                content = content + "</ul>";
                $(".videos").html(content);
            },
            error: function(errMsg) {
                alert(errMsg);
            }
        });

    });
</script>

@stop