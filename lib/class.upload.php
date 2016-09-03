<?php 
class upload {
 


 public function up ($name, $tmp_name, $location) {


move_uploaded_file($tmp_name, $loaction);







 }




}





?>