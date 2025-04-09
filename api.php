<?php
header("Content-Type: application/json");

$host = 'localhost';
$db = 'inventory_db';
$user = 'root';
$pass = '';
$port = 3307;

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die(json_encode(['message' => "Connection failed: " . $conn->connect_error]));
}

$endpoint = $_GET['endpoint'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

// Support method override (for DELETE via POST)
$methodOverride = $input['_method'] ?? '';
if ($method === 'POST' && strtoupper($methodOverride) === 'DELETE') {
    $method = 'DELETE';
}

// ------------------- PRODUCTS -------------------
// ------------------- PRODUCTS -------------------
if ($endpoint === 'products') {
    switch ($method) {
        case 'GET':
            $sql = "SELECT 
                        p.id, 
                        p.name, 
                        p.sale_price, 
                        p.quantity, 
                        c.name AS category, 
                        m.file_name AS image,
                        s.name AS supplier
                    FROM products p
                    LEFT JOIN categories c ON p.categorie_id = c.id
                    LEFT JOIN media m ON p.media_id = m.id
                    LEFT JOIN suppliers s ON p.supplier_id = s.id";

            $result = $conn->query($sql);
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            echo json_encode($products);
            break;

        case 'POST':
            $name = $conn->real_escape_string($input['name']);
            $sale_price = floatval($input['sale_price']);
            $quantity = intval($input['quantity']);
            $categorie_id = intval($input['categorie_id'] ?? 1);
            $media_id = intval($input['media_id'] ?? 0);
            $supplier_id = intval($input['supplier_id'] ?? 0);

            $sql = "INSERT INTO products (name, sale_price, quantity, categorie_id, media_id, supplier_id, date) 
                    VALUES ('$name', $sale_price, $quantity, $categorie_id, $media_id, $supplier_id, NOW())";

            if ($conn->query($sql)) {
                echo json_encode(['message' => 'Product added successfully']);
            } else {
                echo json_encode(['message' => 'Error: ' . $conn->error]);
            }
            break;

        case 'DELETE':
            $productId = $_GET['id'] ?? $input['id'] ?? null;
            if (!$productId) {
                http_response_code(400);
                echo json_encode(['message' => 'Product ID is required']);
                break;
            }
            $productId = intval($productId);

            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $productId);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Product deleted successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Delete failed: ' . $conn->error]);
            }

            $stmt->close();
            break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
    }
}


// ------------------- CATEGORIES -------------------
if ($endpoint === 'categories') {
    switch ($method) {
        case 'GET':
            $result = $conn->query("SELECT * FROM categories");
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            echo json_encode($categories);
            break;

        case 'POST':
            $name = $conn->real_escape_string($input['name']);

            $sql = "INSERT INTO categories (name) VALUES ('$name')";
            if ($conn->query($sql)) {
                echo json_encode(['message' => 'Category added successfully']);
            } else {
                echo json_encode(['message' => 'Error: ' . $conn->error]);
            }
            break;

        case 'DELETE':
            $categoryId = $_GET['id'] ?? $input['id'] ?? null;
            if (!$categoryId) {
                http_response_code(400);
                echo json_encode(['message' => 'Category ID is required']);
                break;
            }
            $categoryId = intval($categoryId);

            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $categoryId);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Category deleted successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Delete failed: ' . $conn->error]);
            }

            $stmt->close();
            break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
    }
}

// ------------------- INVALID ENDPOINT -------------------
else {
    http_response_code(404);
    echo json_encode(['message' => 'Invalid endpoint']);
}

$conn->close();
