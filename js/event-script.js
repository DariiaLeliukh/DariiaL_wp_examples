(function($){
    $(document).ready(function(){
        var clickcount = 0;
        $(document).on('click', '.events .location>a', function(e){
            console.log('works');
            e.preventDefault();
           
            var location = $(this).attr('value');
            
            console.log('locations: ')
            console.log(location);

            $.ajax({
                url: wpAjax2.ajaxUrl,
                data: { action: 'filter_locations', location:location},
                type: 'post',
                beforeSend: function() { $('#loading').show(); },
                complete: function() { $('#loading').hide(); },
                success: function(result){
                    $(".events-list").fadeIn("slow");
                    $('.events-list').html(result);
                },
                error: function(result){
                    console.warn(result);
                }
            });
        });

    });
})(jQuery);