<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use LightORM\Model;
use LightORM\Table_concrete_model_trait;

class Title extends Model
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
    private $article;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $content) {
        parent::__construct();
        
        $this->id       = $id;
        $this->content  = $content;

        $this->article  = new Undefined();
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

    public function get_article() {
        return $this->article;
    }
    public function set_article($article) {
        $this->article = $article;
    }
    //------------------------------------------------------//
}
