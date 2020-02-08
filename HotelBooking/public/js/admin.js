(function ($) {
	 $(document).ready(function(){
        var url = window.location.href;  
        $(".nav-menu a").each(function(){
            if (url == (this.href)) {
                    $(this).closest("a").addClass("active");
                }
        });
        // $(document).on("click", ".show-menu-btn", function(e){
        $(".show-menu-btn").click(function(e){            
            e.preventDefault();
            $(".wrap").toggleClass("toggled");
        });
        
        var mq = window.matchMedia( "(max-width: 992px)" );
        $(document).mouseup(function(e) 
        {
            var container = $("#side-menu");

            if (!container.is(e.target) && container.has(e.target).length === 0 && mq.matches) 
            {
                $(".wrap").removeClass("toggled");
            }
        });
    });
})(jQuery);