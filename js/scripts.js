// menu open/close
function openMenu( path ){
    // replace and add custom behaviour
    path.children("ul").css({
    	"display": "block",
		"visibility": "visible",
		"opacity": "1",
		"z-index": "200"
    });
    path.children("ul").show();
    path.addClass( 'open-parent' );
}

function closeMenu(path){
    // replace and add custom behaviour
    path.find("ul").css({
		"display": "none",
		"visibility": "hidden",
		"opacity": "0"
	});
}

// Responsive Menus
$(document).ready(function() {

	// detect touch
	if("ontouchstart" in window || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0)){
	    document.documentElement.className += " touch";
	}

	// touch counters
	$(".touch .menu-item-has-children").on('mouseenter', function(){
		$(this).data("touch", 0);
	});

	$(".touch .menu-item-has-children").on('click', function(){
		$(this).data("touch", $(this).data("touch") + 1);
		if($(this).data("touch") < 0){
	        return false;
	    }
	});

	$("html").on('click', function(){
		$(".touch .menu-item-has-children").data("touch", 0);
	});

	// menu events
	$(".touch .menu-item-has-children").on('mouseenter', function(){
	    openMenu( $(this) );
	});

	$(".touch .menu-item-has-children").on('mouseleave', function(){
	    closeMenu( $(this) );
	});

	$(".touch .menu-item-has-children").on('click', function(e){
	    // prevent html click event that closes menu
	    if(e.stopPropagation){
	        e.stopPropagation();
	    }else{
	        e.cancelBubble = true;
	    }
	});

	$(".touch .menu-item-has-children").trigger("mouseenter");
	$(".touch .menu-item-has-children").trigger("mouseleave");

});

(function($) {
	$(document).ready(function() {
		$('#menu-toggle').click(function (e) {
			$('body').toggleClass('menu-shown');
			e.preventDefault();
	    });

	    $('.click-toggle-menu-off').click(function(e){
		    $( 'body' ).toggleClass('menu-shown');
		    e.preventDefault();
		});

	});
})( jQuery );

// Prevent empty search
$(document).ready(function(){
    $('.searchform').submit(function(e) { // run the submit function, pin an event to it
        var s = $( this ).find("#s"); // find the #s, which is the search input id
        if (!s.val()) { // if s has no value, proceed
            e.preventDefault(); // prevent the default submission
            alert("Your search is empty!"); // alert that the search is empty
            $('#s').focus(); // focus on the search input
        }
    });
});