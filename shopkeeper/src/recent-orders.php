<?php
// --- 1. Database connection ---
$pdo = new PDO(
    'mysql:host=localhost;dbname=scms;charset=utf8',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// --- 2. Fetch all orders with their product info in one query ---
$sql = "
    SELECT 
        o.orderId,
        o.id        AS row_id,
        o.created_at,
        o.status,
        o.total,
        o.quantity,
        p.name      AS product_name,
        p.price     AS product_price,
        p.image     AS product_image
    FROM orders o
    JOIN products p ON p.id = o.product_id
    ORDER BY o.orderId, o.id
";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- 3. Group by orderId ---
$orders = [];

foreach ($rows as $r) {
    $oid = $r['orderId'];

    if (!isset($orders[$oid])) {
        // create the order only once per orderId
        $orders[$oid] = [
            'id'     => 'ORD-' . $oid,  // you can adjust the prefix if needed
            'date'   => date('d M Y', strtotime($r['created_at'])),
            'status' => $r['status'],
            'total'  => (int)$r['total'],
            'items'  => []
        ];
    }

    // add each product row as an item
    $orders[$oid]['items'][] = [
        'name'     => $r['product_name'],
        'price'    => (int)$r['product_price'],
        'quantity' => (int)$r['quantity'],
        'image'    => $r['product_image']
    ];
}

// --- 4. Output as JavaScript ---
header('Content-Type: application/javascript');
echo 'export const orders = ' . json_encode(array_values($orders), JSON_PRETTY_PRINT) . ';';
