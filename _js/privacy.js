console.log('privacy js loaded');
var $toggleButton = $('.toggle-icon-container, .value-title-container > h3');

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



