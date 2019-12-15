<?php
namespace Demo_concorde\business\models;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Enum_model;
use Concorde\artefact\Table_enum_model_trait;

class Status extends Enum_model
{
    use Table_enum_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $color;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $name, $color) {
        parent::__construct($id, $name);

        $this->color  = $color;
    }
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     The getters                      //
    //------------------------------------------------------//
    public function get_color() {
        return $this->color;
    }
    //------------------------------------------------------//
}
