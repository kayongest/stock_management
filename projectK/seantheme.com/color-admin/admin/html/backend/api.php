<?php
    // Display all PHP errors (see changelog)
    error_reporting(E_ALL);
    // Turn on the display of errors
    ini_set('display_errors', 0);
    // Optional: Set the display startup errors to on
    ini_set('display_startup_errors', 0);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
?>


<?php
    // Check if the request method is POST OR GET
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
        // Get the raw POST data
        $json = file_get_contents('php://input');

        // Decode the JSON data into a PHP array
        $data = json_decode($json, true);
        // Check if json_decode succeeded
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Invalid JSON data";
            exit;
        }


        // CONNECT TO THE DB AND LOOP THE DATA
        try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            //$db= new PDO('mysql:host=localhost;dbname=moodle', 'admin', 'qyF4zLXvsz',
            $db= new PDO('mysql:host=localhost;dbname=av_event_management', 'clement', 'clement123',
            $pdo_options);

            $results = [];
            //GET The called route
            if($data['action']=='addCategory'){
                $results = addCategory($data['category_name'],$data['category_description'],$data['category_tag'], $db);
            }elseif($data['action']=='getCategories'){
                $results = getCategories($db);
            }elseif($data['action']=='update_dsf'){
                foreach ($data['data'] as $item) {
                    $resultItem = update_dsf($item['email'], $data['nid'], $item['phone'], $db);
                    array_push($results, $resultItem);
                }
            }
            


            header("Content-Type: application/json");
            echo json_encode($results);
        
        }
        catch (Exception $e)
        {
            die('Erreur: '. $e->getMessage());
        }
        
    }
?>

<?php

    function addCategory($category_name, $category_description, $category_tag, $db){
        $statement = "
            INSERT INTO categories (name, Description, tag) 
            VALUES (:category_name, :category_description, :category_tag);";
        $data = array(
            ':category_name' => $category_name,
            ':category_description' => $category_description,
            ':category_tag' => $category_tag
        );
        try {
            $statement = $db->prepare($statement);
            $statement->execute($data);
            return [
                "status" => "success",
                "data" => getCategories($db)
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getCategories($db){
        $statement = "SELECT * FROM categories ORDER BY category_id DESC";
        $result = $db->query($statement);
        return $result->fetchAll();
    }

?>