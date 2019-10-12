<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_abstract_model_trait;

abstract class Person extends Model
{
    use Table_abstract_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $username;
    private $password;
    private $created_at;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $comments;
    private $orders;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $username, $password, $created_at) {
        parent::__construct();
        
        $this->id          = $id;
        $this->username    = $username;
        $this->password    = $password;
        $this->created_at  = $created_at;

        $this->comments  = new Undefined();
        $this->orders    = new Undefined();
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

    public function get_username() {
        return $this->username;
    }
    public function set_username($username) {
        $this->username = $username;
    }

    public function get_password() {
        return $this->password;
    }
    public function set_password($password) {
        $this->password = $password;
    }

    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
    }

    public function get_comments() {
        return $this->comments;
    }
    public function set_comments($comments) {
        $this->comments = $comments;
    }

    public function get_orders() {
        return $this->orders;
    }
    public function set_orders($orders) {
        $this->orders = $orders;
    }
    //------------------------------------------------------//
}
