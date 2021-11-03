jQuery(document).ready(function($) {
    $("body").on("click",".more-option-trigger",function() {
        if($('.more-options-wrapper').hasClass('active')) {
            $('.more-options-wrapper').removeClass('active');
        } else {
            $('.more-options-wrapper').addClass('active');
        }
    });

    //setup before functions
    var typingTimer;
    var doneTypingInterval = 100;
    var $input = $('#find-city2 .bs-searchbox input');

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        if(jQuery(this).val().length >= 3) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping () {
        var data = {
            'action': 'load_cities',
            'search': $('#find-city').val()
        };

        $.ajax({
            url: admin.ajaxurl,
            data:data,
            type:'POST',
            dataType: 'json',
            success:function(data){
                if(data.data.length > 0) {
                    var elements_html = ''
                    $(data.data).each(function(i, obj) {
                        elements_html += '<div class="city-list" data-city-id="'+obj.id+'">'+obj.name+'</div>'
                    });
                    $('#auto-city').addClass('active').html(elements_html);
                } else {
                    $('#auto-city').html('No city found by this name');
                }
            }
        });
    }

    $.on('click', '.city-list', function() {
        var city_id = $(this).attr('data-city-id');
        var city_name = $(this).text();

        $('#filter_city_field').val(city_id);
        $('#find-city').val(city_name);
        $('#auto-city').html('');
        $('.pxp-results-filter-form').submit();
    });

    $.on("click", function(event){
        var $trigger = $("#auto-city.active");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            jQuery("#auto-city.active").removeClass('active');
        }
    });
});