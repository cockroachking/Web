<?
// read information from the TM database about all segments
// that have at least one waypoint endpoint within the
// latitude/longitude bounds given, and then information about
// each route that those segments are parts of
//
$params = json_decode($_POST['params'], true);

// $params has 4 fields: minLat, maxLat, minLng, maxLng that specify
// those bounds

// need to buffer and clean output since tmphpfuncs generates
// some output that breaks the JSON output
ob_start();
require "./tmphpfuncs.php";
ob_end_clean();

// initialize the array of responses
$response = array('roots'=>array(),
		  'w1name'=>array(),
		  'w1lat'=>array(),
		  'w1lng'=>array(),
		  'w2name'=>array(),
		  'w2lat'=>array(),
		  'w2lng'=>array(),
		  'routeroots'=>array(),
		  'routelistnames'=>array()
		  );

// make DB query for all segments with at least one waypoint in
// the bounding area
$result = tmdb_query("select segments.root, w1.pointName as w1name, w1.latitude as w1lat, w1.longitude as w1lng, w2.pointName as w2name, w2.latitude as w2lat, w2.longitude as w2lng from segments join waypoints as w1 on segments.waypoint1=w1.pointId join waypoints as w2 on segments.waypoint2=w2.pointId where ((w1.latitude>".$params['minLat']." and w1.latitude<".$params['maxLat']." and w1.longitude<".$params['maxLng']." and w1.longitude>".$params['minLng'].") or (w2.latitude>".$params['minLat']." and w2.latitude<".$params['maxLat']." and w2.longitude<".$params['maxLng']." and w2.longitude>".$params['minLng']."));");

// temp array of unique root values of the segments
$allroots = array();

// parse results into the response array
while ($row = $result->fetch_assoc()) {

    array_push($response['roots'], $row['root']);
    // did we find a new root we haven't seen before?
    if (!in_array($row['root'], $allroots)) {
       array_push($allroots, $row['root']);
    }
    array_push($response['w1name'], $row['w1name']);
    array_push($response['w1lat'], $row['w1lat']);
    array_push($response['w1lng'], $row['w1lng']);
    array_push($response['w2name'], $row['w2name']);
    array_push($response['w2lat'], $row['w2lat']);
    array_push($response['w2lng'], $row['w2lng']);
}

$result->free();

// build a query to get information about all of the routes
$result = tmdb_query("select * from routes where root in ('".implode("','",$allroots)."');");

// parse results into the response array
while ($row = $result->fetch_assoc()) {
      array_push($response['routeroots'], $row['root']);
      array_push($response['routelistnames'], $row['region']." ".$row['route'].$row['banner'].$row['abbrev']);
}

$tmdb->close();
echo json_encode($response);
?>
