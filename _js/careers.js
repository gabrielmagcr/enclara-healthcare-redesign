
var $btnGroup = $('[data-section-toggle]');
var $body1 = $('.body1'),
    $body2 = $('.body2');
var $carousel = new Flickity('.carousel', {
    prevNextButtons: false,
    autoPlay: true
});
var $toggleButton = $('.toggle-icon-container, .value-title-container > h3');

// Hide body2 by default
$body2.hide();

$btnGroup.on('click', function () {
    var $t = $(this);
    var $tId = $t.attr('id');
    function toggle(el) {
        el.parents('.button-set').find('.is-active').removeClass('is-active');
        el.addClass('is-active');   
    }

    ($t.hasClass('is-active')) ? false : toggle($t);
    
    // Swap out content based on button clicked id
    switch ($tId) {
        case 'why':
            $body1.fadeIn('slow');
            $body2.hide();
            break;
        case 'who':
            $body2.fadeIn('slow');
            $body1.hide();
            break;
        default:
            break;
    }

});


$toggleButton.on('click', $.debounce(100, function() {
    var $parentElement = $(this).parents('.value-item');
    var $valueHiddenContainer = $parentElement.find('.value-hidden-container');

    // Prevent spam clicking. Velocity adds the velocity-animating class during animations
    if($valueHiddenContainer.hasClass('velocity-animating')) {
        return;
    } else if(!$parentElement.hasClass('toggled')) {
            $parentElement.addClass('toggled');
            $valueHiddenContainer.velocity("slideDown", { duration: 200 });
    } else {
        console.log('else hit');
            $parentElement.removeClass('toggled');
            $valueHiddenContainer.velocity("slideUp", { duration: 200 });
    }
}));



