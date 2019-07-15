<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use LightORM\Table_concrete_model_trait;

class Commentator extends Person
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $email;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $username, $password, $created_at, $email) {
        parent::__construct($id, $username, $password, $created_at);
        
        $this->email  = $email;
    }
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                 The getters/setters                  //
    //------------------------------------------------------//
    public function get_email() {
        return $this->email;
    }
    public function set_email($email) {
        $this->email = $email;
    }
    //------------------------------------------------------//
}
