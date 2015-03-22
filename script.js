/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fksInfoMore(e) {
    var elem = jQuery( this );
    var content = elem.parent().find('div').eq(0);
    
    if (elem.attr('value') == 'show'){
        content.slideDown(800);
        elem.attr('value', 'hide');
    }
    else {
        content.slideUp(800);
        elem.attr('value', 'show');
    }
    
}

jQuery('input.fksinfomore_btn').click(fksInfoMore);
