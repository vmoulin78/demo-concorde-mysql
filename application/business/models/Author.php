<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Table_concrete_model_trait;

class Author extends Person
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $is_admin;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $articles;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $username, $password, $created_at, $is_admin) {
        parent::__construct($id, $username, $password, $created_at);
        
        $this->is_admin  = $is_admin;

        $this->articles  = new Undefined();
    }
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                 The getters/setters                  //
    //------------------------------------------------------//
    public function get_is_admin() {
        return $this->is_admin;
    }
    public function set_is_admin($is_admin) {
        $this->is_admin = $is_admin;
    }

    public function get_articles() {
        return $this->articles;
    }
    public function set_articles($articles) {
        $this->articles = $articles;
    }
    //------------------------------------------------------//
}
