<? if (module::get_var("exif_sidebar", "hide_link")  == true) { ?>
  <style type="text/css">
	#g-exif-data-link { display: none; }
  </style>
<? } ?>
<div id="g-exif-tags">
  <ul id="g-tags">
	<? foreach ($tags as $tag): ?>
    <li class="g-tag"><a href="<?= $tag->url() ?>"><?= html::clean($tag->name) ?></a></li>
	<? endforeach; ?>
	</ul>
</div>
<div id="g-exif-data-table">
  <ul class="g-metadata">
  <? foreach ($details as $element) {
		// only show the items that are not on the list from the admin settings.
		$caption = (string)$element["caption"];
		$show = (strlen($show_values) > 0
			? (strpos($show_values, $caption) !== false)
			: (strpos($hide_values, $caption) === false));
		if ($show) {
				if (strtolower($caption) == "date/time")
				{
					$date = new DateTime($element["value"]);
					$element["value"] = $date->format("F jS Y");
				}
	?>
    <li><span class="g-exif-caption"><?= $element["caption"]; ?></span><span class="g-exif-value"><?= $element["value"]; ?></span></li>
  <? 	} // close the if we should show the row.
  }  // close the for each. ?>
  </tbody>
</table>
</div>
