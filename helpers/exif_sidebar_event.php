<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2009 Bharat Mediratta
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
class exif_sidebar_event_Core {
  static function admin_menu($menu, $theme) {
    $menu->get("settings_menu")
      ->append(Menu::factory("link")
               ->id("exif_sidebar")
               ->label(t("EXIF Sidebar"))
               ->url(url::site("admin/exif_sidebar")));
  }
  static function pre_deactivate($data) {
    if ($data->module == "exif") {
      $data->messages["warn"][] = t("The EXIF sidebar module requires the EXIF module.");
    }
  }

  static function module_change($changes) {
    // See if the EXIF module is installed,
    //   tell the user to install it if it isn't.
    if (!module::is_active("exif") || in_array("exif", $changes->deactivate)) {
      site_status::warning(
        t("The EXIF sidebar module requires the EXIF module.  " .
          "<a href=\"%url\">Activate the EXIF module now</a>",
          array("url" => url::site("admin/modules"))),
        "exif_sidebar_needs_exif");
    } else {
      site_status::clear("exif_sidebar_needs_exif");
    }
  }
}