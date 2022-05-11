@extends('layouts.default')
@section('content')

<div>

    <iframe id="video-player" src="https://player.vimeo.com/video/76979871?h=8272103f6e" width="640" height="360" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>


    <div class="videos">
        loading...
    </div>
</div>

<script>
    $(document).ready(function() {
        playit = function(link) {
            alert("yes");
            $('[id*=video-player]').attr('src', link);
        }

        addToPlaylist = function(name, image, link) {
            course = {
                name: name,
                image: image,
                link: link
            };
            console.log(course);
            $.ajax({
                type: "POST",
                url: "/api/course",
                data: JSON.stringify(course),
                contentType: "application/json; charset=utf-8",
                headers: {
                    "Authorization": "Bearer " + window.localStorage.getItem('token')
                },
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                },
                error: function(errMsg) {
                    alert(errMsg);

                }
            });


        }

        $.ajax({
            type: "GET",
            url: "https://api.vimeo.com/videos?direction=asc&filter=categories&query=science",
            contentType: "application/json; charset=utf-8;",
            headers: {
                "Authorization": "Bearer 7dd07b9ae42903ccfea3ba47efa13aed"
            },
            dataType: "json",
            success: function(data) {
                console.log(data.data);
                content = "<ul>";
                $.each(data.data, function(i, data) {
                    course = {
                        name: data.name,
                        image: data.pictures.base_link,
                        link: data.player_embed_url
                    };

                    content = content + "<li class='card'><div class='row'><div class='col-md-2 mb-4'><img src='" + data.pictures.base_link + "' width='100%'/></div><div class='col-md-10 mb-4'><h5>" + data.name + "</h5><p>" + data.description + "</p><button  onclick='playit(\"" + data.player_embed_url + "\")' class='play-video' embed-video-link='" + data.player_embed_url + "'>Play</button> <button onclick='addToPlaylist(\"" + data.name.replace(/["']/g, "") + "\",\"" + data.pictures.base_link + "\",\"" + data.player_embed_url + "\")' >Add to Playlist</button></div></div></li>"
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