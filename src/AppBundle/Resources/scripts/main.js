$(document).ready(function(){
    var preload = document.getElementById("preload");
    var loading = 0;
    var id = setInterval(frame, 1);
    
    function frame() {
        if(loading === 100) {
            clearInterval(id);
            document.getElementById("preload").style.display = "none";
        } else {
          loading = loading + 1;          
          if(loading === 90) {
              console.log("loading", loading);
              preload.style.annimation = "fadeout 1s ease";
          }
        }
    }

    //POPup
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName("close")[0];

    function btn() {
        modal.style.display = "block";

    }

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});

//Facebook share button

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1831947957125489";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

//Facebook login

window.fbAsyncInit = function() {
    FB.init({
        appId   : 1831947957125489,
        oauth   : true,
        status  : true, // check login status
        cookie  : true, // enable cookies to allow the server to access the session
        xfbml   : true // parse XFBML
    });

};

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = response.email; //get user email
                // you can store this data into your database
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());
