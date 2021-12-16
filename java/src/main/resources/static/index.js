document.addEventListener("DOMContentLoaded", function() { 
    var quotes = new Array(
        "„Чем страсть сильнее, тем печальнее бывает у неё конец.“", 
        "„Балет – это искусство превращать движение в искусство.“", 
        "„Любое искусство стремится к тому, чтобы стать музыкой.“", 
        "„У каждого человека под шляпой — свой театр, где развертываются драмы, часто более сложные, чем те, что даются в театрах.“",
        "„На сцене человек должен быть на ступеньку выше, чем в жизни.“",
        "„Искусство — всегда метафора действительности.“",
        "„Много прекрасного существует в мире разрозненно, и это — задача нашего духа: обнаружить связи и тем самым создавать произведения искусства.“"
    ),
    randomize = quotes[Math.floor( Math.random() * quotes.length )];
    document.querySelector('header h1').innerHTML = randomize;
});

$('.button_icon').on('click', function(){
   $('header').toggleClass('open_icon_menu');
})

var gallery = document.querySelectorAll('.photo');

for(var i = 0; i < gallery.length; i++) {
    (function loop(index) {
        gallery[index].addEventListener('click', function(e) {
            document.querySelector('.main_pic').src = gallery[index].getAttribute('src');
        });
    }(i))
}

$(function(){
    $('.fclick').on('click', darkness);
    $('body').on('mousemove', light_move);
    $('body').on('touchmove', light_move_mobile);
})

function light_move(e){
    if($('.fclick').text() == "Включить свет"){
        obj = document.getElementById('overlay');
        obj.style.top = e.clientY   / document.documentElement.clientHeight * 100 - 150 + "vh";
        obj.style.left = 1 * e.clientX / document.documentElement.clientWidth * 100 - 150 + "vw";
    }
}
function light_move_mobile(e){
    if($('.fclick').text() == "Включить свет"){
        obj = document.getElementById('overlay');
        obj.style.top = e.targetTouches[0].clientY   / document.documentElement.clientHeight * 100 - 150 + "vh";
        obj.style.left = 1 * e.targetTouches[0].clientX / document.documentElement.clientWidth * 100 - 150 + "vw";
    }
}
function darkness(){
    if($('.fclick').text() == "Выключить свет"){
        $('body').append("<div id='overlay' class='overlay'></div>");
        $("#overlay")
           .css({
              'position': 'fixed',
              'top': '-100vh',
              'left': '-100vw',
              'background-color': 'black',
              'background': 'radial-gradient(circle, transparent,rgba(0,0,0,0.6),rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6), rgba(0,0,0,0.6))',
              'width': '300vw',
              'height': '300vh',
              'z-index': 5000,
              'pointer-events': 'none'
           });
        $('.fclick').text("Включить свет");
    }
    else{
        $('div.overlay').remove();
        $('.fclick').text("Выключить свет");
    }
}






