<?php
namespace Demo_concorde\business\associations;

defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');

use Concorde\artefact\Association;
use Concorde\artefact\Table_association_trait;

class Discount_Folder_Person extends Association
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
    private $discount;
    private $folder;
    private $person;
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
    public function get_discount() {
        return $this->discount;
    }
    public function set_discount($discount) {
        $this->discount = $discount;
    }

    public function get_folder() {
        return $this->folder;
    }
    public function set_folder($folder) {
        $this->folder = $folder;
    }

    public function get_person() {
        return $this->person;
    }
    public function set_person($person) {
        $this->person = $person;
    }

    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
    }
    //------------------------------------------------------//
}
