
function circle_animate(element,start) {
    let diameter = element.width()/2;
    let element_animate =$(element.data('animate'));
    let elements = element_animate.find('.elements');
    element_animate.css({'top':(diameter - elements.width()/2 )+'px','left':(diameter - elements.width()/2 )+'px'});

    let type = 0.5, //circle type - 1 whole, 0.5 half, 0.25 quarter
        radius = diameter+'px', //distance from center
        // start = -90, //shift start from 0
        $elements = elements,
        numberOfElements = (type === 1) ?  $elements.length : $elements.length - 1, //adj for even distro of elements when not full circle
        slice = 360 * type / numberOfElements;

    $elements.each(function(i) {
        let $self = $(this),
            rotate = slice * i + start,
            rotateReverse = rotate * -1;

        $self.css({
            'transform': 'rotate(' + rotate + 'deg) translate(' + radius + ') rotate(' + rotateReverse + 'deg)'
        });
    });
}
$(document).ready(function () {
    circle_animate($('.animate-training'),-90);
    circle_animate($('.animate-sport'),90);
});

let open_button =  $('.open-dropdown');
if(open_button.length){
    open_button.on('click',function () {
        let parent = $(this).closest('.dropdown-custom');
        parent.toggleClass('show');
        setTimeout(function () {
            $(document).one('click',function (e) {
                if(!(e.target.closest('.dropdown')) && !(e.target.closest('.open-dropdown'))){
                    parent.removeClass('show');
                }
            })
        },0);

    })
}

let menu_trigger = $('.menu-trigger');

menu_trigger.on('click',function () {
    $('body').toggleClass('menu-show');
});




let click_next_h_full = $('.click-next-h-full');

if(click_next_h_full.length){
 click_next_h_full.on('click',function () {
    $(this).next().toggleClass('h-full')
 })
}
