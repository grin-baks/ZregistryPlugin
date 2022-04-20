 "use strict";
$(document).ready(function(){
    $(".fancybox-gallery").fancybox({});
    $('button.delete, button.allow').click(function() {
        var checkboxes = [];
        $('input.checkbox:checked').each(function() {
            checkboxes.push($(this).attr('carid'));
        });
        if (checkboxes.length === 0) {
            alert('No checkbox selected');
            return;
        }
        $.ajax({
            url: wa_backend_url + 'site/?plugin=zregistry&action=moderationcontroller',
            method: 'post',
            dataType: 'html',
            data: {
                data: JSON.stringify(checkboxes),
                mode: $(this).attr('mode')
            },
            success: function(data) {
                location.reload();
            }
        });
    });
});