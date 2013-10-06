<? if (module::get_var("info_sidebar", "hide_link") == true) { ?>
  <style type="text/css">
	#g-info-data-link { display: none; }
  </style>
<? } ?>
<div id="g-info-tags">
  <ul id="g-tags">
	<? foreach ($tags as $tag): ?>
    <li class="g-tag"><a href="<?= $tag->url() ?>"><?= html::clean($tag->name) ?></a></li>
	<? endforeach; ?>
	</ul>
</div>
<div id="g-info-data-table">
  <ul class="g-metadata">
<?
	foreach ($details as $element) {
		// only show the items that are not on the list from the admin settings.
		$caption = (string)$element['caption'];
		$value = (string)$element['value'];
		$show = (strlen($show_values) > 0
			? (strpos($show_values, $caption) !== false)
			: (strpos($hide_values, $caption) === false));
		if ($show) {
			switch (strtolower($caption))
			{
			case "camera model":
				$caption = 'Camera';
				break;

			case "exposure time":
				$caption = 'Exposure';
				break;

			case "focal length":
				$caption = 'Focus';
				break;

			case "date/time":
				$date = new DateTime($element["value"]);
				$value = $date->format("Y-M-d, H:i");
				break;
			}
?>
    <li><span class="g-info-caption"><?= $caption; ?></span><span class="g-info-value"><?= $value; ?></span></li>
<?
		} // close the if we should show the row.
	}  // close the for each.
?>
    <li><span class="g-info-caption">Size</span><span class="g-info-value"><?= $theme->item->width ?>x<?= $theme->item->height ?> px</span></li>
 </ul>
</div>
