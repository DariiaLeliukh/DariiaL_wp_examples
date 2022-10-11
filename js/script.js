(function($){
    $(document).ready(function(){
        var clickcount = 0;
        $(document).on('change', '.js-filter-form', function(e){
            console.log('works');
            e.preventDefault();
           
            var area = $(this).find("select[name='areas'] option:selected" ).val();
            var industries = $(this).find("select[name='industries'] option:selected" ).val();
            var locations = $(this).find("select[name='locations'] option:selected" ).val();

            console.log('Area: ')
            console.log(area);
            
            console.log('industries: ')
            console.log(industries);
            
            console.log('locations: ')
            console.log(locations);
                      
            
            $.ajax({
                url: wpAjax.ajaxUrl,
                data: { action: 'filter', area: area, industries: industries, locations:locations},
                type: 'post',
                beforeSend: function() { $('#loading').show(); },
                complete: function() { $('#loading').hide(); },
                success: function(result){
                    $(".search-results").fadeIn("slow");
                    $('.search-results').html(result);
                },
                error: function(result){
                    console.warn(result);
                }
            });
        });
    });
})(jQuery);