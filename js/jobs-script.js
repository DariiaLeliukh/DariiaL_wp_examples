(function($){
    $(document).ready(function(){
        var clickcount = 0;
        $(document).on('click', '.jobs .location>a', function(e){
            console.log('Jobs works');
            e.preventDefault();
           
            var location = $(this).attr('value');
            
            console.log('locations: ')
            console.log(location);

            $.ajax({
                url: wpAjax3.ajaxUrl,
                data: { action: 'job_filter_locations', location:location},
                type: 'post',
                beforeSend: function() { $('#loading').show(); },
                complete: function() { $('#loading').hide(); },
                success: function(result){
                    $(".jobs-list").fadeIn("slow");
                    $('.jobs-list').html(result);
                },
                error: function(result){
                    console.warn(result);
                }
            });
        });

    });
})(jQuery);