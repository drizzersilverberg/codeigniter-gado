<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function getSubMenu()
    {
        $query = "
            SELECT `sub_menu`.*, `menu`.`menu`
            FROM `sub_menu`
            JOIN `menu` ON `sub_menu`.`menu_id` = `menu`.`id` 
        ";

        return $this->db->query($query)->result_array();
    }

    public function getMenu()
    {
        return $this->db->get('menu')->result_array();
    }
}
