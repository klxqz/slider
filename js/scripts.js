function addSlide()
{
    var url = '?plugin=slider&action=addslide';
            return  $.get(url, function(result) {
                
                $("#slider-slides-content").removeClass('bordered-left').html(result);
                
            });
}
    
