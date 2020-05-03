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
<title>Travel Mapping Developer Tools and Links</title>
</head>

<body>
<?php require  $_SERVER['DOCUMENT_ROOT']."/lib/tmheader.php"; ?>
<h1 style="color:red">Travel Mapping Developer - <i>Draft of a new developer page</i></h1>


<p class="text">

This page gathers information, tools, and other links primarily of
interest to Travel Mapping project contributors.
</br></br>  TM's highway data is developed and maintained by a group
  of <a href="/credits.php#contributors">volunteer project
  contributors</a>.  The data is stored in
  a <a href="https://github.com/TravelMapping/HighwayData">GitHub
  repository</a>, organized as
  described <a href="https://github.com/TravelMapping/HighwayData/blob/master/README.md">here</a>.
  The content at the pages linked below serve as the manual to help
  TM contributors to maintain consistent and high-quality highway data
  for the project.  It is based on the manual from TM's predecessor,
  the Clinched Highway Mapping project.
</p>

<p class="heading">Highway Systems <i>(work in progress)</i></p>
<div class="text">
  <ul>
    <li><a href="manual/sysdef.php">Definition of a system</a></li>
<!--    <li><a href="manual/sysnew.php">Create a new system</a></li>-->
    <li>Create a new system</li>
    <li><a href="manual/syserr.php">Deal with data errors</a></li>
<!--    <li><a href="manual/sysrev.php">Review a preview system</a></li>-->
    <li>Review a preview system</li>
    <li><a href="manual/maintenance.php">Maintain an active system</a></li>
  </ul>
</div>

<p class="heading">Route Files <i>(no changes yet)</i></p>
<div class="text">
  <ul>
    <li><a href="manual/hwydata.php">Highway data files</a></li>
    <li><a href="manual/includepts.php">Waypoints to include</a></li>
    <li><a href="manual/wayptlabels.php">Labeling waypoints</a></li>
    <li><a href="manual/points.php">Positioning waypoints </a></li>
  </ul>
</div>

<p class="heading">Tools</p>
<div class="text">
  <ul>
    <li><a href="/wptedit/">Waypoint File Editor</a>
      <br/>
      Create or modify route files
      <br/>
      <i>TM's update of CHM's WPT file Editor; Goal: develop our own new version</i>
    </li>
    <br/>
    <li><a href="http://courses.teresco.org/metal/hdx/">Highway Data Examiner</a> (HDX)
      <br/>
      View graph and near-miss data
    </li>
    <br/>
    <li><a href="https://github.com/TravelMapping/DataProcessing/blob/master/SETUP.md">Data Verification</a>
      <br/>
      Run site update program to generate the same logs, stats, and database file that are produced as part of the regular site update process
    </li>
    <br/>
    <li><a href="dataerrors.php">Data Errors</a>
      <br/>
      Check highway data errors
    </li>
    <br/>
    <li><a href="logs.php">Log Files</a>
      <br/>
      Additional developer logs for highway data and web site
    </li>
  </ul>
</div>

<?php require  $_SERVER['DOCUMENT_ROOT']."/lib/tmfooter.php"; ?>
</body>
<?php
    $tmdb->close();
?>
</html>
