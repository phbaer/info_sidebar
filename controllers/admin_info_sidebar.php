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
class Admin_info_sidebar_Controller extends Admin_Controller {
  public function index() {
    print $this->_get_view();
  }

  public function handler() {
    access::verify_csrf();

    $form = $this->_get_form();
    if ($form->validate()) {
	  module::set_var (
	    "info_sidebar", "hide_link", $form->info_sidebar->info_sidebar_hide_link->value);
	  module::set_var (
	    "info_sidebar", "show_values", $form->info_sidebar->info_sidebar_show_values->value);
	  module::set_var (
	    "info_sidebar", "hide_values", $form->info_sidebar->info_sidebar_hide_values->value);
      message::success(t("Your settings have been saved."));
      url::redirect("admin/info_sidebar");
    }

    print $this->_get_view($form);
  }

  private function _get_view($form=null) {
    $v = new Admin_View("admin.html");
    $v->content = new View("admin_info_sidebar.html");
    $v->content->form = empty($form) ? $this->_get_form() : $form;
    return $v;
  }

  private function _get_form() {
    $form = new Forge("admin/info_sidebar/handler", "Info sidebar administration.", "post", array("id" => "g-admin-form"));
    $group = $form->group("info_sidebar")->label(t("Sidebar options"));
    $group->checkbox("info_sidebar_hide_link")->label(t("Hide info sidebar dialog link"))
    	->checked(module::get_var("info_sidebar", "hide_link", false) == 1);
	$group->input("info_sidebar_show_values")->label(t('Comma separated list of eliments to show (overrides hide option).'))
		->value(module::get_var("info_sidebar", "show_values"));
	$group->input("info_sidebar_hide_values")->label(t('Comma separated list of eliments <strong>not</strong> to show.'))
		->value(module::get_var("info_sidebar", "hide_values"));
    $group->submit("submit")->value(t("Save"));

    return $form;
  }
}
