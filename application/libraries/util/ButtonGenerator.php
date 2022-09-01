<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
//include_once APPPATH.'libraries/util/CI_Object.php';

class ButtonGenerator {

    public static function editHandler($url) {
        $html = '<a href = "'. $url .'"> <i';
        $html .= ' class="fas fa-edit mr-3 ';
        $html .= 'indigo-text edit_btn"></i></a>';
        return $html;
        return $html;
    }

    public static function deleteHandler($url) {
        
        $html = '<a href = "'. $url .'"> <i';
        $html .= ' class="fas fa-trash mr-3 ';
        $html .= 'indigo-text del_btn"></i></a>';
        return $html;
    }

    public static function updateHandler($id) {
        
        $html = '<a href = "rental/update/'. $id .'"> <i';
        $html .= ' class="fas fa-edit mr-3 ';
        $html .= 'indigo-text edit_btn"></i></a>';
        return $html;
    }

    public static function deleteButton($id, $location) {
        $url = base_url($location);
        $html = '';
        $html .= '
        <a href="'.$url.'/confirm/'.$id.'"><button type="button" class="btn btn-primary">Yes</button></a>
        ';
        $html .= '<a href="'.$url.'"<button type="button" class="btn btn-primary">No</button></a>';
        return $html;
    }

}