
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
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
};

span.onclick = function() {
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
}
};    
});