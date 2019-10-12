<?php
namespace Demo_concorde\business\models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Concorde\utils\php\Undefined;
use Concorde\artefact\Model;
use Concorde\artefact\Table_concrete_model_trait;

class Discount extends Model
{
    use Table_concrete_model_trait;

    //------------------------------------------------------//
    //                   Basic properties                   //
    //------------------------------------------------------//
    private $id;
    private $code_name;
    private $start_date;
    private $end_date;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Associations                     //
    //------------------------------------------------------//
    private $orders;
    //------------------------------------------------------//

    //------------------------------------------------------//
    //                     Constructor                      //
    //------------------------------------------------------//
    public function __construct($id, $code_name, $start_date, $end_date) {
        parent::__construct();
        
        $this->id          = $id;
        $this->code_name   = $code_name;
        $this->start_date  = $start_date;
        $this->end_date    = $end_date;

        $this->orders  = new Undefined();
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

    public function get_code_name() {
        return $this->code_name;
    }
    public function set_code_name($code_name) {
        $this->code_name = $code_name;
    }

    public function get_start_date() {
        return $this->start_date;
    }
    public function set_start_date($start_date) {
        $this->start_date = $start_date;
    }

    public function get_end_date() {
        return $this->end_date;
    }
    public function set_end_date($end_date) {
        $this->end_date = $end_date;
    }

    public function get_orders() {
        return $this->orders;
    }
    public function set_orders($orders) {
        $this->orders = $orders;
    }
    //------------------------------------------------------//
}
