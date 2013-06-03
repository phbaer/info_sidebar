<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2012 Bharat Mediratta
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
class info_sidebar_installer {

  static function install() {
    // Set the module's version number.
    module::set_version("info_sidebar", 1);
  }

  static function can_activate() {
    $messages = array();
    if (!module::is_active("exif")) {
      $messages["warn"][] = t("The info sidebar module requires the EXIF module.");
    }
    return $messages;
  }
  static function deactivate() {
    site_status::clear("info_sidebar_needs_exif");
  }
  static function uninstall() {
    module::delete("info_sidebar");
  }
}
