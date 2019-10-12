<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_concrete_model_trait;

class Tag extends Model
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $content;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $articles;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $content) {
        parent::__construct();
        
        $this->id       = $id;
        $this->content  = $content;

        $this->articles  = new Undefined();
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

    public function get_content() {
        return $this->content;
    }
    public function set_content($content) {
        $this->content = $content;
    }

    public function get_articles() {
        return $this->articles;
    }
    public function set_articles($articles) {
        $this->articles = $articles;
    }
    //------------------------------------------------------//
}
