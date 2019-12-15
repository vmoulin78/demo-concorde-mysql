<?php
namespace Demo_concorde\business\models;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_concrete_model_trait;

class Folder extends Model
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $name;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $parent_folder;
    private $subfolders;
    private $articles;
    private $orders;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $name) {
        parent::__construct();
        
        $this->id    = $id;
        $this->name  = $name;

        $this->parent_folder  = new Undefined();
        $this->subfolders     = new Undefined();
        $this->articles       = new Undefined();
        $this->orders         = new Undefined();
    }
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                 The getters/setters                  //
    //------------------------------------------------------//
    public function get_id() {
        return $this->id;
    }
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_name() {
        return $this->name;
    }
    public function set_name($name) {
        $this->name = $name;
    }

    public function get_parent_folder() {
        return $this->parent_folder;
    }
    public function set_parent_folder($parent_folder) {
        $this->parent_folder = $parent_folder;
    }

    public function get_subfolders() {
        return $this->subfolders;
    }
    public function set_subfolders($subfolders) {
        $this->subfolders = $subfolders;
    }

    public function get_articles() {
        return $this->articles;
    }
    public function set_articles($articles) {
        $this->articles = $articles;
    }

    public function get_orders() {
        return $this->orders;
    }
    public function set_orders($orders) {
        $this->orders = $orders;
    }
    //------------------------------------------------------//
}
