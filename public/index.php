<style>
    table {
        width: 100%; text-align:center;
    }
    td{
        border: 1px solid #ddd;
    }
</style>
<?php
//$xml=simplexml_load_file('057-6776453695.xml');//load xml file
$xml=simplexml_load_file('BreakPointTest.xml');//load xml file
$json_string = json_encode($xml);//convert xml to json
$result_array = json_decode($json_string, TRUE);

$AirSegment = $result_array["AirSegments"]['AirSegment'];//path to airsegment part in the json file
$q=count($AirSegment);//how many flights we had
echo "2. Round trip is";
echo "<table>";//show the route via table
echo "<tr><th>Departure date/time</th>
	  <th>Board</th>
	  <th>Arrival date/time</th>
	  <th>Off</th></tr>
	 ";

for ($i=0; $i<=($q-1);$i++){//display route
    echo "<tr><td>";
    echo $AirSegment[$i]['Departure']['@attributes']['Date'].' '.$AirSegment[$i]['Departure']['@attributes']['Time'];
    echo "</td><td>";
    echo $AirSegment[$i]['Board']['@attributes']['City'];
    echo "</td><td>";
    echo $AirSegment[$i]['Arrival']['@attributes']['Date'].' '.$AirSegment[$i]['Arrival']['@attributes']['Time'];
    echo "</td><td>";
    echo $AirSegment[$i]['Off']['@attributes']['City'];
    echo "</td></tr>";

    $airDate[] = $AirSegment[$i]['Arrival']['@attributes']['Date'].' '.$AirSegment[$i]['Arrival']['@attributes']['Time'];// create date and time
    $off[] = $AirSegment[$i]['Off']['@attributes']['City'];//array with all oof
    $board[] = $AirSegment[$i]['Board']['@attributes']['City'];//array with all boards

}

echo "</table><br>";

$maxs = array_keys($airDate, max($airDate));//find key of latest fly
echo "1. The end point is ".$AirSegment[$maxs[0]]['Off']['@attributes']['City'];//show latest off city
echo "<br>";
echo "<br>";
for ($i=0;$i<=($q-1);$i++){
    echo $board[$i]."<br>";
if(in_array("$board[$i]",$off)){
    $breakpoint="There were no break points.";
}else{
    $breakpoint=$off[$i];
    }
}
print_r($board);
echo "Break point: ". $breakpoint;

$os = array("Mac", "NT", "Irix", "Linux");
if (in_array("Irix", $os)) {
    echo "Нашел Irix";
}else{echo 'no irix there';}
if (in_array("mac", $os)) {
    echo "Нашел mac";
}


