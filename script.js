/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fksInfoMore(e) {
    var show_str = LANG.plugins.fksinfomore.show;
    var hide_str = LANG.plugins.fksinfomore.hide;
    
    var butt = jQuery( this );
    var content = butt.parent().find('div').eq(0);
    
    if (butt.html() === show_str){
        content.slideDown(800);
        butt.html(hide_str);
    }
    else {
        content.slideUp(800);
        butt.html(show_str);
    }
    
}

jQuery(function(){
    jQuery('button.fksinfomore_btn').click(fksInfoMore);
});
