<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_concrete_model_trait;

class Comment extends Model
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $content;
    private $created_at;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $person;
    private $article;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $content, $created_at) {
        parent::__construct();
        
        $this->id          = $id;
        $this->content     = $content;
        $this->created_at  = $created_at;

        $this->person   = new Undefined();
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

    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
    }

    public function get_person() {
        return $this->person;
    }
    public function set_person($person) {
        $this->person = $person;
    }

    public function get_article() {
        return $this->article;
    }
    public function set_article($article) {
        $this->article = $article;
    }
    //------------------------------------------------------//
}
