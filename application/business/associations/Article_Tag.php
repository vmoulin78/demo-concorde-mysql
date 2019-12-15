<?php
namespace Demo_concorde\business\associations;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\artefact\Association;
use Concorde\artefact\Table_association_trait;

class Article_Tag extends Association
{
    use Table_association_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $created_at;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                      Associates                      //
    //------------------------------------------------------//
    private $article;
    private $tag;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($created_at) {
        parent::__construct();

        $this->created_at  = $created_at;
    }
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                 The getters/setters                  //
    //------------------------------------------------------//
    public function get_article() {
        return $this->article;
    }
    public function set_article($article) {
        $this->article = $article;
    }

    public function get_tag() {
        return $this->tag;
    }
    public function set_tag($tag) {
        $this->tag = $tag;
    }

    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
    }
    //------------------------------------------------------//
}
