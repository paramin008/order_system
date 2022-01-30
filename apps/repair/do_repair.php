<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "create_repair"){


    $req = array(
      
        "technician" => isset($_POST["technician"]) ? $_POST["technician"] : "0",
        "description" => isset($_POST["description"]) ? $_POST["description"] : "",
        "inventory_id" => $_POST["inven"],
        "call1" => $_POST["call1"],
        "number" => $_POST["number"],
      
        "user_id" => $_SESSION["USER_ID"],
    );

    $required = array(
        
        "description" => "Description",   
        "inventory_id" => "inventory_id",
        "call1" => "call1",
        "number" => "number",
       
        "user_id" => "User ID",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        if($_SESSION["POSITION"] == "2"){
            header("location:../../index.php?page=dashboard");
        }else{
            header("location:../../index.php?page=repair");
        }
       
        exit();
    }

    $req["description"] = filter_var_string($_POST["description"], "Description");

try{

    $sql = "INSERT INTO `repair` SET ";
  
    $sql .= " `description` = :description, ";
    $sql .= " `inventory_id` = :inventory_id, ";
    $sql .= " `call1` = :call1, ";
    $sql .= " `number` = :number, ";
    $sql .= " `technician` = :technician, ";
   
    $sql .= " `user_id` = :user_id ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
   
    $stmt->bindParam(":description",$req["description"]);
    $stmt->bindParam(":inventory_id",$req["inventory_id"]);

    $stmt->bindParam(":call1",$req["call1"]);
    $stmt->bindParam(":number",$req["number"]);

    $stmt->bindParam(":technician",$req["technician"]);
   
    $stmt->bindParam(":user_id",$req["user_id"]);
    $result = $stmt->execute();
    $id = $conn->lastInsertId();
    $status_id = "14";
    if($result){
       
    $sql = "INSERT INTO `repair_detail` SET ";
    $sql .= " `repair_id` = :repair_id, ";
   
    $sql .= " `status_id` = :status_id ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$id, PDO::PARAM_INT);
    $stmt->bindParam(":status_id",$status_id, PDO::PARAM_INT);
    
    $result = $stmt->execute();
    

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }

      
}
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "repair_id" => $_GET["repair_id"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair");
        exit();
    }


try{
    $sql = "DELETE FROM `repair`  ";
    $sql .= "  WHERE `id` = :repair_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "repair_id" => $_POST["ch"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair");
        exit();
    }

    $arr = array();

    foreach($_POST["ch"] as $v){
        $arr[] = explode(",",$v);
    }

    $user_id = "";

    foreach($arr as $v){
        $user_id .= $v[0].",";

    }


    $repair_id = substr($user_id, 0,-1);


try{
    $sql = "DELETE FROM `repair`  ";
    $sql .= "  WHERE `id` IN ($repair_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successful data deletion.", false);
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "created_detail"){

    $req = array(
        "note" => filter_var_string($_POST["note"], "Note"),
        "status" => $_POST["status"],
        "repair_id" => $_POST["repair_id"],
    );

    $required = array(
        "status" => "status",   
        "repair_id" => "repair_id",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
    }

try{

    $sql = "INSERT INTO `repair_detail` SET ";
    $sql .= " `repair_id` = :repair_id, ";
    $sql .= " `note` = :note, ";
    $sql .= " `status_id` = :status ";
    // $sql .= "  WHERE `id` = :id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"]);
    $stmt->bindParam(":note",$req["note"]);
    $stmt->bindParam(":status",$req["status"]);
    $result = $stmt->execute();
    $id = $conn->lastInsertId();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
     
    }

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}



}elseif(isset($_GET["action"]) && $_GET["action"] == "update_repair"){

    

    $req = array(
        "technician" => $_POST["technician"],
        "repair_id" => $_POST["repair_id"],
        "description" => $_POST["description"],
        "number" => $_POST["number"],
        "call1" => $_POST["call1"],
        "Address" => $_POST["Address"],
        "Customer_name" => $_POST["Customer_name"],
        "date" => $_POST["date"],
        "inventory_id" => $_POST["inven"],
        "status" => $_POST["status"],
    );

    $required = array(
        "technician" => "technician",  
        "repair_id" => "repair_id", 
        "description" => "description",
        "number" => "number",
        "call1" => "call1",
        "Address" => "Address",
        "Customer_name" => "Customer_name",
        "date" => "date",
        "inventory_id" => "inventory_id",
        "status" => "status",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = lang("Invalid Data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
    }

try{

    $sql = "UPDATE `repair` SET ";
    $sql .= " `technician` = :technician, ";
    $sql .= " `description` = :description, ";
    $sql .= " `call1` = :call1, ";
    $sql .= " `number` = :number, ";
    $sql .= " `Address` = :Address, ";
    $sql .= " `Customer_name` = :Customer_name, ";
    $sql .= " `inventory_id` = :inventory_id,";
    $sql .= " `status` = :status,";
    $sql .= " `date` = :date";
    $sql .= "  WHERE `id` = :repair_id ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"]);
    $stmt->bindParam(":description",$req["description"]);
    $stmt->bindParam(":number",$req["number"]);
    $stmt->bindParam(":call1",$req["call1"]);
    $stmt->bindParam(":inventory_id",$req["inventory_id"]);
    $stmt->bindParam(":Address",$req["Address"]);
    $stmt->bindParam(":Customer_name",$req["Customer_name"]);
    $stmt->bindParam(":date",$req["date"]);
    $stmt->bindParam(":status",$req["status"]);
    $stmt->bindParam(":technician",$req["technician"]);
   
    $result = $stmt->execute();
 
    

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = lang("Successfully saved data.", false);
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
     
    }

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}



}else{
    defined('APPS') OR exit('No direct script access allowed');
}

?>


