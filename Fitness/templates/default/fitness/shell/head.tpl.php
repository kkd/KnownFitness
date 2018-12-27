<?php if (!\Idno\Core\Idno::site()->plugins()->get('Fitness')) { ?>
  <link rel="stylesheet" href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-0.7.7/leaflet.css"/>
  <script type="text/javascript" src="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-0.7.7/leaflet-src.js"></script>
<?php } ?>

<?php
$weight = \Idno\Core\Idno::site()->config()->fitness['weight'];
if (empty($weight)){
    $weight = '98%';
}
$height = \Idno\Core\Idno::site()->config()->fitness['height'];
if (empty($height)){
    $height = '300px';
}
?> 

<link rel="stylesheet" href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-elevation/leaflet.elevation-0.0.4.css" />
<script src="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-elevation/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-elevation/leaflet.elevation-0.0.4.min.js"></script>
<script type="text/javascript" src="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>IdnoPlugins/Fitness/external/leaflet-omnivore/leaflet-omnivore.js"></script>

<?php /* FIXME: remove my token! */ ?>
<script type="text/javascript">
L.mapbox.accessToken = 'pk.eyJ1IjoiZmx5aW5ndHJvbGxleWNhcnMiLCJhIjoiUU1PT3k2RSJ9.YjUouHi0jFUbizq5W2-liA';
</script>

<style type="text/css">
.gpx { border: 5px #aaa solid; border-radius: 5px;
  box-shadow: 0 0 3px 3px #ccc;
  width: <?=$weight?>; margin: 1em auto; }
.gpx header { padding: 0.5em; }
.gpx h3 { margin: 0; padding: 0; font-weight: bold; }
.gpx .start { font-size: smaller; color: #444; }
.gpx .map { border: 1px #888 solid; border-left: none; border-right: none;
  width: <?=$weight?>; height: <?=$height?>; margin: 0; }
.gpx footer { background: #f0f0f0; padding: 0.5em; }
.gpx ul.info { list-style: none; margin: 0; padding: 0; font-size: smaller; }
.gpx ul.info li { color: #666; padding: 2px; display: inline; }
.gpx ul.info li span { color: black; }
</style>
