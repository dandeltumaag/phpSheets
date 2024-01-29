<?php 

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1UphLw88T1c2J30wCB58y-Dn_mWNa84EBEJpLAwxtqAc";

// // CREATE NEW ROW IN GOOGLE SHEET
// $range = "BLISTT";
// $values = [
// 	["This", "is", "new", "row"]
// ];
// $body = new Google_Service_Sheets_ValueRange([
// 	'values' => $values
// ]);
// $params = [
// 	'valueInputOption' => 'RAW'
// ];
// $insert = [
// 	"insertDataOption" => "INSERT_ROWS"
// ];
// $result = $service->spreadsheets_values->append(
// 	$spreadsheetId,
// 	$range,
// 	$body,
// 	$params,
// 	$insert
// );

// RETRIEVE DATA FROM GOOGLE SHEET
$range = "BLISTT!A2:C";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if(empty($values)){
	print "No data found.\n";
} else {
	$mask = "%20s %-20s %s\n";
	
	print "<table>";	
	foreach ($values as $row){
		if(!empty($row))
		print "<tr>";
		print "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>";
		print "</tr>";
	}
	print "</table>";	
}

// if(empty($values)){
// 	print "No data found.\n";
// } else {
// 	$mask = "%20s %-20s %s\n";
// 	foreach ($values as $row){
// 		if(!empty($row))
// 			echo sprintf($mask, $row[0], $row[1], $row[2]);
// 	}
// }

// // UPDATING COLUMN IN GOOGLE SHEET
// $range = "BLISTT!A284:B284";
// $values = [
// 	["test edit", "test 2 edit"]
// ];
// $body = new Google_Service_Sheets_ValueRange([
// 	'values' => $values
// ]);
// $params = [
// 	'valueInputOption' => 'RAW'
// ];
// $result = $service->spreadsheets_values->update(
// 	$spreadsheetId,
// 	$range,
// 	$body,
// 	$params
// );

// // DELETE COLUMN IN GOOGLE SHEET
// $range = 'BLISTT!A287:F287'; // the range to clear, the 23th and 24th lines
// $clear = new \Google_Service_Sheets_ClearValuesRequest();
// $service->spreadsheets_values->clear($spreadsheetId, $range, $clear);





