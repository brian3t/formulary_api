<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<?php
require_once '../protected/vendor/autoload.php';
use GeoIp2\Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader=new Reader('/home/engine/public_html/assets/maxmind/GeoLite2-City.mmdb');

?>
<h3>Client side IP geolocation using <a href="http://ipinfo.io">ipinfo.io</a></h3>

<hr/>
<div id="ip"></div>
<div id="address"></div>
<hr/>Full response:
<pre id="details"></pre>

<script>
	$.get("http://ipinfo.io", function (response) {
		$("#ip").html("IP of your browser: " + response.ip);
		$("#address").html("Location: " + response.city + ", " + response.region);
		$("#details").html(JSON.stringify(response, null, 4));
	}, "jsonp");


	function getOctet() {
		return Math.round(Math.random()*255);
	}

	function randIp () {


		//generate the ipaddress
		var  ipaddress_string = getOctet()
			+ '.' + getOctet()
			+ '.' + getOctet()
			+ '.' + getOctet();

		//write the ipaddress to text field
		document.getElementById('ip-input').innerHTML =
			ipaddress_string;
		document.getElementById('ip-input').value =
			ipaddress_string;

	}
</script>

<?php
// Replace "city" with the appropriate method for your database, e.g.,
// "country".
if(!empty($_GET['ip-input']))
{
	$ip=$_GET['ip-input'];
} else
{
	$ip = $_SERVER['REMOTE_ADDR'];
	if ($ip === '127.0.0.1' || empty($ip)){
		$ip='198.2.44.170';
	}
}
$record=$reader->city($ip);
?>

<h3>Client side IP geolocation using iAdly maxmind hosted database</h3>
<div>
	<div>
		<form id="submit_ip" action="#">
			<label for="ip">Enter IP address to query, such as 198.2.44.170:</label><input id="ip-input" name="ip-input" value="<?=$ip?>"/>
			<button type="submit">Submit</button>
			<span>Or click here to generate random IP</span>
			<button type="button" onclick="randIp()">Generate Random</button>
		</form>
	</div>
	<?php
	echo("<br/>IP Address: " . $ip. "\n"); // 'US'
	echo("<br/>Country Code: " . $record->country->isoCode . "\n"); // 'US'
	echo("<br/>Country Name: " . $record->country->name . "\n"); // 'United States'

	print("<br/> Subdivision name: " . $record->mostSpecificSubdivision->name . "\n");
	print("<br/> Subdivision isoCode: " . $record->mostSpecificSubdivision->isoCode . "\n");
	echo("<br/> City: " . $record->city->name);


	echo("<br/>Postal Code: " . $record->postal->code); // '55455'

	print("<br/>Latitude: " . $record->location->latitude); // 44.9733
	print("<br/>Longitude: " . $record->location->longitude); // -93.2323
	?>
</div>