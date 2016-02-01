/*enable tabs to be selected*/
$('.nav a').click(function (e) {
    // e.preventDefault();
    $(this).tab('show');
})

/*4*/
$("#toggle_button").click( function(e){
    $d = $($(".dropdown-toggle" )[0]);
    
    //A programmatic api for toggling menus for a given navbar or tabbed navigation.
    $d.dropdown('toggle');
    
    return false;
});

/*6 select dynamically one tab by using a dropdown menu
    * @see http://getbootstrap.com/javascript/#tabs
    * */
$("#myTab .dropdown-menu a").click( function(e){
    
    var source = $(this).data("source");
    
    if( source )
    {
        $('#myTab a[href="#' + source + '"]').tab('show');
    }
    
    return false;
});

/*9 setting up the position of the nav container */
$("#nav_position a").click( function(e){
    
    var position = $(this).data("position");
    var $nav = $("#nav_position");
    var $body = $("body");
    
    
    $nav.removeClass( "navbar-fixed-bottom");
    $nav.removeClass( "navbar-fixed-top");
    
    //Body padding required
    $body.css( "padding-top", "0" );
    $body.css( "padding-bottom", "0" );
    
    switch( position )
    {
        case "normal":
            console.log( "normal nav position is already applied.. :)");
            break;
        case "top":
            $body.css( "padding-top", $nav.height() );
            $nav.addClass( "navbar-fixed-top");
            break;
        case "bottom":
            $body.css( "padding-bottom", $nav.height() );
            $nav.addClass( "navbar-fixed-bottom");
            break;
    }
    
    return false;
});

/*
     10. listen for scroll events using scrollspy navigation
     @see http://getbootstrap.com/javascript/#scrollspy
     */
$('#myScrollspy').on('activate.bs.scrollspy', function (e) {
    
    var $target = $(e.target);
    var link;
    
    if( $target.hasClass('dropdown'))
    {
        link = $target.find("li.active a");
    }
    else
    {
        link = $target.find("a");
    }
    
    $disabled_link =  $( $(this).find( ".disabled a" )[0] );
    $disabled_link.html( 'selected_tab: ' + $(link).html() );
});