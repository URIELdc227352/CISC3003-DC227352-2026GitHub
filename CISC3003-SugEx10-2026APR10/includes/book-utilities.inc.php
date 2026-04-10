<?php
/**
 * Reads customers from a semicolon-delimited text file.
 * Fields: id; first; last; email; university; address; city; state; country; zip; phone; sales
 */
function readCustomers($filename) {
    $customers = [];
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $data = explode(';', $line);
            if (count($data) >= 12) {
                $customers[] = [
                    'id' => $data[0],
                    'first' => $data[1],
                    'last' => $data[2],
                    'email' => $data[3],
                    'university' => $data[4],
                    'address' => $data[5],
                    'city' => $data[6],
                    'state' => $data[7],
                    'country' => $data[8],
                    'zip' => $data[9],
                    'phone' => $data[10],
                    'sales' => $data[11]
                ];
            }
        }
    }
    return $customers;
}

/**
 * Reads orders for a specific customer from a semicolon-delimited text file.
 * Fields: orderId; customerId; isbn; title; category
 */
function readOrders($customerId, $filename) {
    $orders = [];
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $data = explode(',', $line);
            
            // 使用 trim() 过滤匹配的客户 ID (索引为 1)
            if (count($data) >= 5 && trim($data[1]) == trim($customerId)) {
                $orders[] = [
                    'orderId'  => trim($data[0]),
                    'isbn'     => trim($data[2]),
                    'title'    => trim($data[3]),
                    'category' => trim($data[4])
                ];
            }
        }
    }
    return $orders;
}
?>