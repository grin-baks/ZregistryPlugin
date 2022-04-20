<?php

/**
* This class generates fields for the add car form.
*/

class siteZregistryPluginGetFormController extends waController
{

	public function execute()
	{
	 $filds['address_type'] = [
        'title' => 'Where seen *',
        'control_type' => waHtmlControl::RADIOGROUP,
        'options' => array(
            array(
                'value' => 'home',
                'title' => 'Parking place',
				'description' => 'A place where the car is regularly located, such as overnight parking, in the courtyard of the house, etc.',
			),
            array(
                'value' => 'road',
                'title' => 'Случайное место',
				'description' => 'For example, if you saw a car on the road, then the exact address is not important. It will be enough to indicate the city and street. Or even just the city.',

            ),
        ),
        'value' => 'on',
		];

	$filds['address'] = [
	'title' => 'Address where the car was seen *',
	'description' => 'If the car is seen at the place of regular parking, indicate the location in as much detail as possible',
	'control_type' => waHtmlControl::INPUT,
	];

	$filds['car_number'] = [
	'title' => 'Car number *',
	'description' => '3 cyrillic letters and 3 numbers, for example А111АА',
	'control_type' => waHtmlControl::INPUT,
	];

	$filds['region_number'] = [
	'title' => 'Region code *',
	'description' => '2 or 3 digits',
	'control_type' => waHtmlControl::INPUT,
	];

	$controlParams = array(
    'control_wrapper'     => '<div class="field"><div class="name">%s</div><div class="value">%s%s</div></div>',
    'title_wrapper'       => '%s',
    'description_wrapper' => '<br><span class="hint">%s</span>'
	);

	$htmlForm = '<form action="'.wa()->getConfig()->getRootUrl(true).'addcar/" method="post"  id="addCarForm" enctype="multipart/form-data" target="plugins-settings-iframe">';

	$htmlForm .= '<div class="field"><div class="name"><label name="photo">Upload a photo Z-car: *</label></div><div class="value"><input type="file" accept="image/png, image/jpeg" name="photo[]" multiple></div></div><br>';

	foreach($filds as $key => $element){			
	$htmlForm .= waHtmlControl::getControl($element['control_type'] ,  $key ,$element + $controlParams ) . '<br>';
	}

	//Adding captcha
	$waReCaptcha = new waPHPCaptcha(['sitekey' => 'w7l5B6Nb' , 'secret'=> '6NbmHoA']);
	$htmlForm .= $waReCaptcha->getHtml();
	$htmlForm .= '<div class="field">
                        <div class="value submit">
                            <input type="submit" class="submitform button green" value="Submit Information">
                            <span id="plugins-settings-form-status" style="display:none"><!-- message placeholder --></span>
                        </div>
    </div></form>';
	echo $htmlForm;
	}
}