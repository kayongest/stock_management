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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the raw POST data
        $json = file_get_contents('php://input');

        // Decode the JSON data into a PHP array
        $data = json_decode($json, true);
        // Check if json_decode succeeded
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Invalid JSON data";
            exit;
        } // test codes

        // CONNECT TO THE DB AND LOOP THE DATA
        try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            //$db= new PDO('mysql:host=localhost;dbname=moodle', 'admin', 'qyF4zLXvsz',
            $db= new PDO('mysql:host=localhost;dbname=av_event_management', 'clement', 'clement123',
            $pdo_options);

            $results = [];
            // Called the Routes
            if($data['action']=='addCategory'){
                $results = addCategory($data['category_name'],$data['category_description'],$data['category_tag'],$data['category_model'], $db);
            }elseif($data['action']=='getCategories'){
                $results = getCategories($db);
            }elseif($data['action']=='addBrand'){
                $results = addBrand($data['brand_name'],$db);
            }elseif($data['action']=='getBrands'){
                $results = getBrands($db);
            }elseif($data['action']=='addItem'){
                $results = addItem($data['categories'], $data['brands'], $data['serial_number'], $db);
            }elseif($data['action']=='getItems'){
                $results = getItems($db);
            }elseif($data['action']=='generateQrs'){
                $results = generateQrs($db);
            }
            


            header("Content-Type: application/json");
            echo json_encode($results);
        
        }
        catch (Exception $e)
        {
            die('Erreur: '. $e->getMessage());
        }
        
    }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            //$db= new PDO('mysql:host=localhost;dbname=moodle', 'admin', 'qyF4zLXvsz',
            $db= new PDO('mysql:host=localhost;dbname=av_event_management', 'clement', 'clement123',
            $pdo_options);
            $_GET['action']($db);
        } catch (Exception $e)
        {
            die('Erreur: '. $e->getMessage());
        }
        
    }
?>

<?php
    // START CATEGORIES
        function addCategory($category_name, $category_description, $category_tag, $category_model, $db){
            $statement = "
                INSERT INTO categories (name, Description, tag, category_model) 
                VALUES (:category_name, :category_description, :category_tag, :category_model);";
            $data = array(
                ':category_name' => $category_name,
                ':category_description' => $category_description,
                ':category_tag' => $category_tag,
                ':category_model' => $category_model,
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
    // END CATEGORIES

    // START BRANDS
        function addBrand($brand_name, $db){
            $statement = "
                INSERT INTO brands (name) 
                VALUES (:brand_name);";
            $data = array(':brand_name' => $brand_name);
            try {
                $statement = $db->prepare($statement);
                $statement->execute($data);
                return [
                    "status" => "success",
                    "data" => getBrands($db)
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        function getBrands($db){
            $statement = "SELECT * FROM brands ORDER BY brand_id DESC";
            $result = $db->query($statement);
            return $result->fetchAll();
        }
    // END BRANDS

    // START ITEMS
        function addItem($category_id, $brand_id, $serial_number , $db) {
            // Function to generate unique alphanumeric code
            function generateUniqueCode($db) {
                do {
                    // Generate a code starting with # followed by 6 alphanumeric characters
                    $code = '#' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
                    
                    // Check if the code exists in the database
                    $stmt = $db->prepare("SELECT COUNT(*) FROM items WHERE serial_number = :code");
                    $stmt->execute([':code' => $code]);
                    $count = $stmt->fetchColumn();
                } while ($count > 0); // Repeat until a unique code is found
                
                return $code;
            }
        
            // Generate a unique serial number
            $item_code = generateUniqueCode($db);
        
            // Prepare SQL to insert data
            $statement = "
                INSERT INTO items (item_code, category_id, brand_id, serial_number, item_status) 
                VALUES (:item_code, :category_id, :brand_id, :serial_number, 'NEW');
            ";
            $data = array(
                ':category_id' => $category_id,
                ':brand_id' => $brand_id,
                ':serial_number' => $serial_number,
                ':item_code' => $item_code
            );
        
            try {
                $statement = $db->prepare($statement);
                $statement->execute($data);
                addToTransactions($db->lastInsertId(), '1', $db);
                return [
                    "status" => "success",
                    "data" => getBrands($db)
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        function getItems($db){
            $statement = "SELECT 
                            I.id, 
                            I.item_code, 
                            B.name AS brand_name, 
                            C.name AS category_name, 
                            C.tag AS category_tag, 
                            C.description AS item_description, 
                            I.serial_number,
                            I.item_status, 
                            I.date_added,
                            IFNULL(
                                (SELECT ST.stock_name 
                                FROM transactions T 
                                JOIN stock ST ON T.locationId = ST.id 
                                WHERE T.itemId = I.id ORDER BY T.transactionId DESC
                                LIMIT 1), 
                                'Unknown'
                            ) AS stock_location
                        FROM 
                            items I
                        JOIN 
                            brands B ON B.brand_id = I.brand_id
                        JOIN 
                            categories C ON C.category_id = I.category_id
                        ORDER BY 
                            I.id DESC;";

            $result = $db->query($statement);

            return [
                "status" => "success",
                "items" => $result->fetchAll()
            ];
        }
    // END ITEMS

    // START QR CODES
        function generateQrs($db) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        
            // Get items from the database
            $response = getItems($db);
        
            if (!$response['items'] || count($response['items']) === 0) {
                throw new Exception('No items found');
            }
        
            try {
                require_once __DIR__ . '/helper/generateqrcodes.php';
        
                // Extract only the item codes from the response
                $item_code = [];
                foreach ($response['items'] as $item) {
                    $item_code[] = $item['item_code'];
                }
        
                // Example usage: Generate QR Code PDF with item codes
                generateQRCodePDFWithItems($item_code);
        
                // Exit after the PDF is output
                exit;
        
            } catch (\Throwable $th) {
                // Output JSON response only on error
                header('Content-Type: application/json');
                echo json_encode([
                    "status" => "error",
                    "message" => $th->getMessage(),
                    "file" => $th->getFile(),
                    "line" => $th->getLine(),
                ]);
                exit;
            }
        }
    // END QR CODES

    // TRANSACTIONS START
        function addToTransactions($itemId, $locationId, $db){
            $statement = "INSERT INTO transactions (itemId, locationId) VALUES (:itemId, :locationId);";
        
            $data = [':itemId' => $itemId, ':locationId' => $locationId];
            try {
                $statement = $db->prepare($statement);
                $statement->execute($data);
                return [
                    "status" => "success",
                    "data" => $db->lastInsertId()
                ];
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    // TRANSACTIONS END
?>