<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use LightORM\Enum_model;
use LightORM\Table_enum_model_trait;

class Status extends Enum_model
{
    use Table_enum_model_trait;

    const NAMES = array(
        'DRAFT'     => 'draft',
        'ONLINE'    => 'online',
        'ARCHIVED'  => 'archived',
    );

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
