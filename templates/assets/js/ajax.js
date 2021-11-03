jQuery(document).ready(function($) {
    // setup before functions
    var typingTimer;
    var doneTypingInterval = 100;
    var $input = $('#search_city');

    // on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        if($(this).val().length >= 3) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        } else if($(this).val().length === 0) {
            $('#search_area_id').val('');
            create_shortcode();
        }
    });

    // on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    // user is "finished typing," do something
    function doneTyping () {
        var data = {
            'action': 'load_cities',
            'search': $('#search_city').val()
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
                        elements_html += '<div class="city-list" data-city-id="'+obj.id+'">'+obj.name+' (ID: '+obj.id+')</div>'
                    });
                    $('#auto-city').html(elements_html);
                    $('#auto-city').addClass('active');
                } else {
                    $('#auto-city').html('No city found by this name');
                }
            }
        });
    }

    $('body').on('click', '.city-list', function() {
        var city_id = $(this).attr('data-city-id');
        var city_name = $(this).text();
        $('#search_city').val(city_name);
        $('#search_area_id').val(city_id);
        $('#auto-city').html('');
        $('.pxp-results-filter-form').submit();
        create_shortcode();
    });

    $(document).on("click", function(event){
        var $trigger = jQuery("#auto-city.active");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $("#auto-city.active").removeClass('active');
        }
    });

    function create_shortcode() {
        var shortcode = [];
        var id;
        var value;

        $(".modal-content").find('.gen-item').each(function(index) {
            if($(this).find('input').length && $(this).find('input').val().length > 0 && $(this).find('input').attr('id') !== 'search_city') {
                id = $(this).find('input').attr('id');
                value = $(this).find('input').val();

                shortcode.push({
                    'name': id,
                    'value': value
                });

            } else if($(this).find('select').length  && $(this).find('select').val().length > 0) {
                id = $(this).find('select').attr('id');
                value = $(this).find('select').val();

                shortcode.push({
                    'name': id,
                    'value': value
                });
            }
        });

        $(".ks-cboxtags li").each(function(index) {
            if($(this).find('input').length && $(this).find('input').val().length > 0 && $(this).find('input').is(':checked')) {
                id = $(this).find('input').val();
                value = 'true';

                shortcode.push({
                    'name': id,
                    'value': value
                });
            }
        });

        var code_shortcode = "[openbroker";
        $(shortcode).each(function(index, item) {
            code_shortcode = code_shortcode+" "+item.name+"='"+item.value+"'";
        });
        code_shortcode = code_shortcode + "]";

        $('#post-result').html(code_shortcode);
        $('#for-php-code').html(code_shortcode);
    }

    $('body').on('input, change', '.gen-item input, .gen-item select, .ks-cboxtags input', function() {
        create_shortcode();
    });
});