<?php
class Search extends DataBoundObject {

        protected $paraula;
        protected $total;
        protected $lastvisit;

        protected function DefineTableName() {
                return("login_details");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "paraula" => "paraula",
                        "total" => "total",
                        "lastvisit" => "lastvisit"  
                ));
        }

}

?>
