<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2011 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class info_sidebar_block_Core {
  static function get_site_list() {
    return array("info_side" => t("Info sidebar data"));
  }

  static function get($block_id, $theme) {
  $item = $theme->item();
    if ($item && $item->is_photo()) {
      $record = db::build()
        ->select("key_count")
        ->from("info_records")
        ->where("item_id", "=", $item->id)
        ->execute()
        ->current();
      if ($record && $record->key_count) {
      $block = new Block();
      switch ($block_id) {
      case "info_side":
        $block->css_id = "g-info-sidebar";
        $block->title = t("EXIF data");
        $block->content = new View("info_sidebar_block.html");
        $block->content->details = exif::get($item);
				$block->content->show_values = module::get_var("info_sidebar", "show_values");
				$block->content->hide_values = module::get_var("info_sidebar", "hide_values");
        $block->content->tags = tag::item_tags($item);
      break;
      }
    return $block;
	  }
	}
  }
}

