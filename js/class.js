//////////////////class page///////////////////////////

// nav section
const mobileBtn = document.getElementById('mobile-cta')
      nav = document.querySelector('nav')
      mobileBtnExit = document.getElementById('mobile-exit');

mobileBtn.addEventListener('click', () => {
    nav.classList.add('menu-btn')
});

mobileBtnExit.addEventListener('click', () => {
    nav.classList.remove('menu-btn')
});

document.addEventListener('mouseup', function(e) {
    if (!e.target.matches('.menu-btn')) {
        nav.classList.remove('menu-btn')
    }
});

// class page show sections
document.getElementById("show_teacher").addEventListener("click",
    function () {
        document.querySelector("#content").style.display = "none";
        document.querySelector("#participants").style.display = "none";
        document.querySelector("#teacher").style.display = "block";
        document.getElementById("show_teacher").style.color="#6472F9";
        document.getElementById("show_teacher").style.borderBottomStyle = "Solid";
        document.getElementById("show_content").style.color = "white";
        document.getElementById("show_content").style.borderBottomStyle = "none";
        document.getElementById("show_participants").style.color = "white";
        document.getElementById("show_participants").style.borderBottomStyle = "none";
});
document.getElementById("show_content").addEventListener("click",
    function () {
        document.querySelector("#content").style.display = "block";
        document.querySelector("#teacher").style.display = "none";
        document.querySelector("#participants").style.display = "none";

        document.getElementById("show_content").style.color = "#6472F9";
        document.getElementById("show_content").style.borderBottomStyle = "Solid";
        document.getElementById("show_teacher").style.color = "white";
        document.getElementById("show_teacher").style.borderBottomStyle = "none";
        document.getElementById("show_participants").style.color = "white";
        document.getElementById("show_participants").style.borderBottomStyle = "none";
});
document.getElementById("show_participants").addEventListener("click",
    function () {
        document.querySelector("#participants").style.display = "block";
        document.querySelector("#teacher").style.display = "none";
        document.querySelector("#content").style.display = "none";

        document.getElementById("show_participants").style.color = "#6472F9";
        document.getElementById("show_participants").style.borderBottomStyle = "Solid";
        document.getElementById("show_teacher").style.color = "white";
        document.getElementById("show_teacher").style.borderBottomStyle = "none";
        document.getElementById("show_content").style.color = "white";
        document.getElementById("show_content").style.borderBottomStyle = "none";
});


/*
document.getElementById("show_options").addEventListener("click",
    function () {
        document.querySelector(".e_r").style.display = "block";
        document.getElementById("show_options").style.display = "none";
        document.getElementById("close_options").style.display = "block";
    }
);
document.getElementById("close_options").addEventListener("click",
    function () {
        document.querySelector(".e_r").style.display = "none";
        document.getElementById("show_options").style.display = "block";
        document.getElementById("close_options").style.display = "none";
    }
);
*/

// edit-student list
var parentBoxes = document.getElementById('participants');

parentBoxes.addEventListener('click', function(e) {
    if (e.target.matches('.edit_std')) {
        var idClickedButton = String(e.target.id);
        var boxToShow = document.getElementById('remove' + idClickedButton[idClickedButton.length - 1]);
        boxToShow.style.display = "block";
        window.setTimeout(function(){
            boxToShow.style.opacity = 1;
            boxToShow.style.transform = 'scale(1)';
        },0);
    }
    e.stopPropagation();
})

document.addEventListener('mouseup', function(e) {
    if (!e.target.matches('.remove')) {
        var moreBoxes = document.querySelectorAll('.remove');
        moreBoxes.forEach(moreBox => {
            moreBox.style.opacity = 0;
            moreBox.style.transform = 'scale(0)';
            moreBox.style.display = 'none';
        })
    }
});

// edit-post list
var parentBoxes = document.getElementById('content');

parentBoxes.addEventListener('click', function(e) {
    if (e.target.matches('.show_options')) {
        var idClickedButton = String(e.target.id);
        var boxToShow = document.getElementById('e_r' + idClickedButton[idClickedButton.length - 1]);
        boxToShow.style.display = "block";
        window.setTimeout(function(){
            boxToShow.style.opacity = 1;
            boxToShow.style.transform = 'scale(1)';
        },0);
    }
    e.stopPropagation();
})

document.addEventListener('mouseup', function(e) {
    if (!e.target.matches('.e_r')) {
        var moreBoxes = document.querySelectorAll('.e_r');
        moreBoxes.forEach(moreBox => {
            moreBox.style.opacity = 0;
            moreBox.style.transform = 'scale(0)';
            moreBox.style.display = 'none';
        })
    }
});


// create-post pop up
function showCreate() {
    var createBox = document.getElementById('bg-popup');
    createBox.style.display = "block";
    window.setTimeout(function(){
        createBox.style.opacity = 1;
        createBox.style.transform = 'scale(1)';
    },0);
}

function hideCreate() {
    var createBox = document.getElementById('bg-popup');
    createBox.style.display = "none";
    createBox.style.opacity = 0;
    createBox.style.transform = 'scale(0)';
}

// show no posts yet if no posts
if(!document.getElementById("post1")) {
    document.getElementById('no-posts').style.display = "block";
};

// show "show all comments" yet if more than 1 comment exist
let commentsSections = document.querySelectorAll('.comments');

commentsSections.forEach( function(element) {
    var commentsID = String(element.id);
    var commentID = "comment" + commentsID[commentsID.length - 1] + "2";
    if(!document.getElementById(commentID)) {
        seeMoreID = "see-more" + commentsID[commentsID.length - 1];
        document.getElementById(seeMoreID).style.display = "none";
    };
});



$(function(){
    // Always show last 1 comment:
    $( ".comments" ).each(function( index ) {
     $(this).children(".comment").slice(-1).show();
    });

    $(".see-more").click(function(e){ // click event for load more
        e.preventDefault();
        var link = $(this);
        $(this).siblings(".comment:hidden").show(1, function() {
    if ($(this).is(':visible')) {
            link.text('Hide comments');
            $(this).addClass('showing-more')
    }        
    });	
    
    if ($('div').hasClass('showing-more')) {
        link.text('Show all comments');
        $('.showing-more').hide(1);
        $('div').removeClass("showing-more");
    }
    
    });
});

 /*
$(document).ready(function() {
    $('textarea').on('keyup keypress', function() {
      $(this).height(0);
      $(this).height(this.scrollHeight);
    });
});


.input_info {
    all: unset;
    overflow: visible;
    width: 100%;
    resize: none;
    box-sizing: border-box;
    white-space: pre-line;
    white-space: pre-wrap;
}
*/