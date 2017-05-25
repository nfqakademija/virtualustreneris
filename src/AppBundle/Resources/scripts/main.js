$(document).ready(
    function () {
        var preload = document.getElementById("preload");
        var loading = 0;
        var id = setInterval(frame, 1);
        function frame()
        {
            window.scrollTo(0, 0);
            if (loading === 100) {
                clearInterval(id);
                document.getElementById("preload").style.display = "none";
                var overflow_status = document.getElementById("overflow");
                if (overflow_status == null)
                {
                    document.body.style.overflow = 'auto';
                }
            } else {
                loading = loading + 1;
                if (loading === 90) {
                    console.log("loading", loading);
                    preload.style.annimation = "fadeout 1s ease";
                }
            }
        }

        //POPup
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        function btn()
        {
            modal.style.display = "block";
        }

        span.onclick = function () {
            modal.style.display = "none";
        };
        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    }
);

//Facebook share button

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return; }
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/lt_LT/sdk.js#xfbml=1&version=v2.9&appId=1831947957125489";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));