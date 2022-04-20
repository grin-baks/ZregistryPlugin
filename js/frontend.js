"use strict";
$(document).ready(function() {
    //Called after fancybox is initialized
    function fancyComplete() {
        $('input#wahtmlcontrol_region_number').mask('009');
        $('input#wahtmlcontrol_car_number').mask('Z000ZZ', {
            translation: {
                'Z': {
                    pattern: /[АВЕКМНОРСТУХавекмнорстух]/,
                    optional: false
                }
            }
        });
        $('input.submitform.button').click(function() {
            //validation
            let iserror = false;
            //files
            if ($('input[type="file"]').val() === '') {
                $('label[name="photo"]').attr('style', 'color: #e20909');
                iserror = true;
            } else {
                $('label[name="photo"]').attr('style', 'color: #444');
            }
            //Where seen
            if ($('input[name="address_type"]:checked').val() === undefined) {
                $('label[for="wahtmlcontrol_address_type"]').attr('style', 'color: #e20909');
                iserror = true;
            } else {
                $('label[for="wahtmlcontrol_address_type"]').attr('style', 'color: #444');
            }
            //other fields
            $('input.input').each(function(index) {
                if ($(this).val() === '') {
                    $(this).addClass('error');
                    iserror = true;
                } else {
                    $(this).removeClass('error');
                }
            });
            if (iserror) {
                alert('Please fill in all required fields');
            } else {
                //sending
                let formData = new FormData(document.getElementById("addCarForm"));
                $.ajax({
                    type: "POST",
                    url: wa_url + 'addcar/',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.error === 1) {
                            alert(data.msg);
                        } else {
                            $.fancybox.close();
                            alert(data.msg);
                        }
                    }
                });
            }
			
            return false;
        });
    }
    $('#addCar').click(function() {
        $.fancybox.open({
            afterShow: fancyComplete,
            type: 'ajax',
            href: wa_url + 'GetForm/'
        });
    });
});