$(document).ready(function(){
    $( '.dropdown-menu li' ).on( 'click', function( event ) {
        var $checkbox = $(this).find('.checkbox');
        if (!$checkbox.length) {
            return;
        }
        var $input = $checkbox.find('input');
        var $icon = $checkbox.find('span.glyphicon');
        if ($input.is(':checked')) {
            $input.prop('checked',false);
            $icon.removeClass('glyphicon-check').addClass('glyphicon-unchecked')
        } else {
            $input.prop('checked',true);
            $icon.removeClass('glyphicon-unchecked').addClass('glyphicon-check')
        }
        return false;
    }); 
})