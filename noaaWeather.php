<?php
    header("Content-type: text/xml");

    $weather_url = 'https://w1.weather.gov/xml/current_obs/KORL.xml';
    $filename = '/volume1/web/cisco/KORL.xml';

    $context = stream_context_create(array("http" => array(
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36")));

	$weather_data = file_get_contents($weather_url,false,$context);
	file_put_contents($filename, $weather_data);
    
	$xml = simplexml_load_file($filename);
?>

<CiscoIPPhoneText>
    <Title>National Weather Service</Title>
	<Text>
<?php 
    echo "Weather: $xml->weather\n";
    echo "Temperature: $xml->temperature_string\n";
	echo "Dewpoint: $xml->dewpoint_string\n";
	echo "Relative Humidity: $xml->relative_humidity %\n";
	echo "Wind: $xml->wind_string\n";
	echo "Visibility: $xml->visibility_mi mi\n";
	echo "Pressure: $xml->pressure_in in Hg";
?>
    </Text>
    <Prompt><?php echo $xml->location ?></Prompt>
</CiscoIPPhoneText>

