<?php
namespace Demo_concorde\business\models;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_concrete_model_trait;

class Article extends Model
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $status;
    private $categories;
    private $created_at;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $title;
    private $paragraphs;
    private $author;
    private $comments;
    private $tags;
    private $folder;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $status, $categories, $created_at) {
        parent::__construct();
        
        $this->id          = $id;
        $this->status      = $status;
        $this->categories  = $categories;
        $this->created_at  = $created_at;

        $this->title       = new Undefined();
        $this->paragraphs  = new Undefined();
        $this->author      = new Undefined();
        $this->comments    = new Undefined();
        $this->tags        = new Undefined();
        $this->folder      = new Undefined();
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

    public function get_status() {
        return $this->status;
    }
    public function set_status($status) {
        $this->status = $status;
    }

    public function get_categories() {
        return $this->categories;
    }
    public function set_categories($categories) {
        $this->categories = $categories;
    }

    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
    }

    public function get_title() {
        return $this->title;
    }
    public function set_title($title) {
        $this->title = $title;
    }

    public function get_paragraphs() {
        return $this->paragraphs;
    }
    public function set_paragraphs($paragraphs) {
        $this->paragraphs = $paragraphs;
    }

    public function get_author() {
        return $this->author;
    }
    public function set_author($author) {
        $this->author = $author;
    }

    public function get_comments() {
        return $this->comments;
    }
    public function set_comments($comments) {
        $this->comments = $comments;
    }

    public function get_tags() {
        return $this->tags;
    }
    public function set_tags($tags) {
        $this->tags = $tags;
    }

    public function get_folder() {
        return $this->folder;
    }
    public function set_folder($folder) {
        $this->folder = $folder;
    }
    //------------------------------------------------------//
}
