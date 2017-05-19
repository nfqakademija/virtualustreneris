$('#fullpage').fullpage(
    {
        anchors: ['page1', 'page2', 'page3', 'page4'],
        sectionsColor: ['#094d6a', '#002635', '#2c3e50', '#ebebeb'],
        scrollingSpeed: 700,
        menu: '#menu',
        css3: true,
        afterLoad: function (anchorLink, index) {
            var loadedSection = $(this);
            //clear
            document.getElementById("button1").style.backgroundColor = "rgba(255, 255, 255, 0.5)";
            document.getElementById("button1").style.borderRadius = "10px";
            document.getElementById("button2").style.backgroundColor = "rgba(255, 255, 255, 0.5)";
            document.getElementById("button2").style.borderRadius = "10px";
            document.getElementById("button3").style.backgroundColor = "rgba(255, 255, 255, 0.5)";
            document.getElementById("button3").style.borderRadius = "10px";
            document.getElementById("button4").style.backgroundColor = "rgba(255, 255, 255, 0.5)";
            document.getElementById("button4").style.borderRadius = "10px";
            //using index
            if (index == 1) {
                document.getElementById("button1").style.backgroundColor = "rgba(19, 126, 170, 1)";
                document.getElementById("button1").style.borderRadius = "10px";
            }
            if (index == 2) {
                document.getElementById("button2").style.backgroundColor = "rgba(5, 63, 85, 1)";
                document.getElementById("button2").style.borderRadius = "10px";
            }
            if (index == 3) {
                document.getElementById("button3").style.backgroundColor = "rgba(111, 126, 145, 1)";
                document.getElementById("button3").style.borderRadius = "10px";
            }
            if (index == 4) {
                document.getElementById("button4").style.backgroundColor = "rgba(102, 102, 102, 1)";
                document.getElementById("button4").style.borderRadius = "10px";
            }
        }
    }
);

//adding the action to the button
$(document).on(
    'click',
    '#moveDown',
    function () {
        $.fn.fullpage.moveSectionDown();
    }
);