<?php
namespace Demo_concorde\business\models;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Table_concrete_model_trait;

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
