<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<link rel="stylesheet" type="text/css" href="/css/travelMapping.css" />

<!-- jQuery -->
<script type="application/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- TableSorter -->
<script type="application/javascript" src="/lib/jquery.tablesorter.min.js"></script>
<?php require $_SERVER['DOCUMENT_ROOT']."/lib/tmphpfuncs.php" ?>
<title>Travel Mapping Developer Logs</title>
</head>

<body>
<?php require  $_SERVER['DOCUMENT_ROOT']."/lib/tmheader.php"; ?>
<h1>Travel Mapping Developer Logs</h1>

<p class="heading"><a name="hwylogs"></a><a style="text-decoration:none" href="#hwylogs">&#x1f517</a>
  Highway Data Development Logs</p>

<?php
//$sql_command = "select count(*) as c from datacheckErrors join routes on datacheckErrors.route = routes.root join systems on routes.systemName = systems.systemName where systems.level=\"active\" and falsePositive=\"0\"";
$activedc = tm_count_rows("datacheckErrors", "join routes on datacheckErrors.route = routes.root join systems on routes.systemName = systems.systemName where systems.level=\"active\" and falsePositive=\"0\"");
?>

<div class="text">
<ul>
  <li><a href="../logs/pointsinuse.log">Waypoint labels in use by current TM users</a>
    <br />
    To be considered if wpt files of active systems are modified to avoid breaking user files, can be loaded to CHM's WPT file Editor.</li>
  <li><a href="../logs/unusedaltlabels.log">Alternate (i.e., hidden) waypoint labels not in use by current TM users</a>
    <br />
    These alternate labels can safely be removed from wpt files.</li>
  <li><a href="../logs/unprocessedwpts.log">List of unprocessed wpt files</a>
    <br />
    Waypoint files in the repository that were not processed because they were not listed in any highway system's csv files</li>
  <li><a href="../graphs/">Travel Mapping Graph Data</a>
    <br />
    Graphs can be loaded into HDX to verify unexpected or broken concurrencies.</li>
</ul>
</div>


<p class="heading"><a name="nmplogs"></a><a style="text-decoration:none" href="#nmplogs">&#x1f517</a>
  Highway Data Development Logs - NMP</p>

<div class="text">
Near-miss points (NMPs) are waypoints very close together and might be candidates to merge. NMP files can be loaded into HDX to visualize their positions on a map.
<ul>
  <li><a href="../logs/tm-master.nmp">Master NMP file with all near-miss points of the project</a></li>
  <li><a href="../logs/nmpbyregion/">NMP files filtered by region (individual files)</a></li>
  <li><a href="../logs/nmpbyregion/nmpbyregion.zip">NMP files filtered by region (zip archive)</a></li>
  <li><a href="../logs/nearmisspoints.log">Log of all near-miss point entries for marking false positives (FP)</a></li>
  <li><a href="../logs/nmpfpsunmatched.log">Log of unmatched FP entries from nmpfps.log</a></li>
</ul>
</div>

<p class="heading"><a name="weblogs"></a><a style="text-decoration:none" href="#weblogs">&#x1f517</a>
  Web Site Development and Site Update Logs</p>

<div class="text">
<ul>
<li><a href="../logs/siteupdate.log">Complete output log from the site update process</a></li>
<li><a href="../logs/highwaydatastats.log">Log of highway data stats, useful to verify web code</a></li>
<li><a href="../logs/concurrencies.log">List of highway concurrencies detected</a></li>
</ul>
</div>

<?php require  $_SERVER['DOCUMENT_ROOT']."/lib/tmfooter.php"; ?>
</body>
<?php
    $tmdb->close();
?>
</html>