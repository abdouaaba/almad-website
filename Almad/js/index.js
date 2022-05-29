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


// more-box pop up
var parentBoxes = document.getElementById('classes-area');

parentBoxes.addEventListener('click', function(e) {
    if (e.target.matches('.more')) {
        var idClickedButton = String(e.target.id);
        var boxToShow = document.getElementById('more-box' + idClickedButton[idClickedButton.length - 1]);
        boxToShow.style.display = "block";
        window.setTimeout(function(){
            boxToShow.style.opacity = 1;
            boxToShow.style.transform = 'scale(1)';
        },0);
    }
    e.stopPropagation();
})

document.addEventListener('mouseup', function(e) {
    if (!e.target.matches('.more-box')) {
        var moreBoxes = document.querySelectorAll('.more-box');
        moreBoxes.forEach(moreBox => {
            moreBox.style.opacity = 0;
            moreBox.style.transform = 'scale(0)';
            moreBox.style.display = 'none';
        })
    }
});

// add-box pop up
function showAdd() {
    var addBox = document.getElementById('add-box');
    addBox.style.display = "block";
    window.setTimeout(function(){
        addBox.style.opacity = 1;
        addBox.style.transform = 'scale(1)';
    },0);
}

document.addEventListener('mouseup', function(e) {
    var addBox = document.getElementById('add-box');
    if (!addBox.contains(e.target)) {
        addBox.style.opacity = 0;
        addBox.style.transform = 'scale(0)';
        addBox.style.display = 'none';
    }
});

// join-box pop up
function showJoinBox() {
    var joinBox = document.getElementById('join-box');
    joinBox.style.display = "block";
    window.setTimeout(function(){
        joinBox.style.opacity = 1;
        joinBox.style.transform = 'scale(1)';
    },0);
}

document.addEventListener('mouseup', function(e) {
    var joinBox = document.getElementById('join-box');
    if (!joinBox.contains(e.target)) {
        joinBox.style.opacity = 0;
        joinBox.style.transform = 'scale(0)';
        joinBox.style.display = 'none';
    };
});

// show no classes yet if no classes
if(!document.getElementById("box1")) {
    document.getElementById('no-classes').style.display = "block";
};


// create class pop up
document.getElementById("pop_up").addEventListener("click", function() {
    document.querySelector("#bg-pop_up").style.display = "flex";
});

document.getElementById("close-pop_up").addEventListener("click", function() {
    document.querySelector("#bg-pop_up").style.display="none";
});

document.getElementById("prv").addEventListener("click", function () {
    document.querySelector(".nombre-std").style.display = "block";
    document.getElementById("max_std").required = true; 
});

document.getElementById("pb").addEventListener("click", function () {
    document.querySelector(".nombre-std").style.display = "none";
});


