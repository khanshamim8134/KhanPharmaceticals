<?php
// Include database configuration
require_once 'config.php';

// Get database connection
$conn = getDBConnection();

// Medicine data for Pain Relief and Antibiotics
$medicines = array(
    // Pain Relief Category
    array(
        'product_name' => 'Paracetamol 500mg',
        'product_code' => 'KP-PR-001',
        'category' => 'Pain Relief',
        'description' => 'Effective pain reliever and fever reducer. Suitable for headaches, muscle aches, and general pain management.',
        'price' => 15.50,
        'stock_quantity' => 5000,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Ibuprofen 400mg',
        'product_code' => 'KP-PR-002',
        'category' => 'Pain Relief',
        'description' => 'Anti-inflammatory pain reliever. Recommended for menstrual pain, arthritis, and chronic pain conditions.',
        'price' => 22.75,
        'stock_quantity' => 3500,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Aspirin 100mg',
        'product_code' => 'KP-PR-003',
        'category' => 'Pain Relief',
        'description' => 'Low-dose aspirin for pain relief and heart health. Ideal for mild to moderate pain and inflammation.',
        'price' => 18.00,
        'stock_quantity' => 4200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Naproxen 250mg',
        'product_code' => 'KP-PR-004',
        'category' => 'Pain Relief',
        'description' => 'Long-acting NSAID for sustained pain relief. Perfect for arthritis and joint pain management.',
        'price' => 28.50,
        'stock_quantity' => 2800,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Diclofenac 50mg',
        'product_code' => 'KP-PR-005',
        'category' => 'Pain Relief',
        'description' => 'Potent NSAID for severe pain and inflammation. Recommended by doctors for acute pain conditions.',
        'price' => 25.99,
        'stock_quantity' => 3800,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),

    // Antibiotic Category
    array(
        'product_name' => 'Amoxicillin 500mg',
        'product_code' => 'KP-AB-001',
        'category' => 'Antibiotic',
        'description' => 'Broad-spectrum antibiotic effective against bacterial infections. Used for respiratory, urinary, and skin infections.',
        'price' => 32.00,
        'stock_quantity' => 4500,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Azithromycin 250mg',
        'product_code' => 'KP-AB-002',
        'category' => 'Antibiotic',
        'description' => 'Macrolide antibiotic for various bacterial infections. Effective against respiratory and skin infections.',
        'price' => 38.75,
        'stock_quantity' => 3200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Ciprofloxacin 500mg',
        'product_code' => 'KP-AB-003',
        'category' => 'Antibiotic',
        'description' => 'Fluoroquinolone antibiotic for serious infections. Used for urinary tract, respiratory, and GI infections.',
        'price' => 45.50,
        'stock_quantity' => 2600,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Doxycycline 100mg',
        'product_code' => 'KP-AB-004',
        'category' => 'Antibiotic',
        'description' => 'Tetracycline antibiotic for acne and respiratory infections. Also effective for Lyme disease treatment.',
        'price' => 35.25,
        'stock_quantity' => 3900,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Cephalexin 500mg',
        'product_code' => 'KP-AB-005',
        'category' => 'Antibiotic',
        'description' => 'Cephalosporin antibiotic for skin and respiratory infections. Safe alternative for penicillin-allergic patients.',
        'price' => 40.00,
        'stock_quantity' => 3400,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Metronidazole 400mg',
        'product_code' => 'KP-AB-006',
        'category' => 'Antibiotic',
        'description' => 'Antibiotic for anaerobic bacterial and parasitic infections. Effective for gastrointestinal infections.',
        'price' => 28.99,
        'stock_quantity' => 3600,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),

    // Cardiovascular Category
    array(
        'product_name' => 'Amlodipine 5mg',
        'product_code' => 'KP-CV-001',
        'category' => 'Cardiovascular',
        'description' => 'Calcium channel blocker for hypertension and angina. Helps relax blood vessels and improve blood flow.',
        'price' => 42.00,
        'stock_quantity' => 4200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Lisinopril 10mg',
        'product_code' => 'KP-CV-002',
        'category' => 'Cardiovascular',
        'description' => 'ACE inhibitor for hypertension and heart failure. Reduces blood pressure and protects the heart.',
        'price' => 38.50,
        'stock_quantity' => 3800,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Metoprolol 50mg',
        'product_code' => 'KP-CV-003',
        'category' => 'Cardiovascular',
        'description' => 'Beta blocker for hypertension and heart conditions. Reduces heart rate and blood pressure effectively.',
        'price' => 35.99,
        'stock_quantity' => 3500,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Atorvastatin 20mg',
        'product_code' => 'KP-CV-004',
        'category' => 'Cardiovascular',
        'description' => 'Statin for cholesterol management. Reduces risk of heart disease and stroke.',
        'price' => 48.75,
        'stock_quantity' => 4100,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Aspirin 325mg',
        'product_code' => 'KP-CV-005',
        'category' => 'Cardiovascular',
        'description' => 'Antiplatelet medication for heart attack and stroke prevention. Daily use recommended for high-risk patients.',
        'price' => 22.00,
        'stock_quantity' => 5500,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Losartan 50mg',
        'product_code' => 'KP-CV-006',
        'category' => 'Cardiovascular',
        'description' => 'ARB medication for hypertension and kidney protection. Alternative to ACE inhibitors.',
        'price' => 44.50,
        'stock_quantity' => 3300,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Diltiazem 30mg',
        'product_code' => 'KP-CV-007',
        'category' => 'Cardiovascular',
        'description' => 'Calcium channel blocker for heart rate and blood pressure control. Used for arrhythmias and angina.',
        'price' => 46.99,
        'stock_quantity' => 3600,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Furosemide 20mg',
        'product_code' => 'KP-CV-008',
        'category' => 'Cardiovascular',
        'description' => 'Loop diuretic for fluid management in heart failure and hypertension. Reduces excess body fluid.',
        'price' => 32.00,
        'stock_quantity' => 4000,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Enalapril 5mg',
        'product_code' => 'KP-CV-009',
        'category' => 'Cardiovascular',
        'description' => 'ACE inhibitor for hypertension and congestive heart failure. Improves blood flow and reduces workload on heart.',
        'price' => 40.50,
        'stock_quantity' => 3700,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Clopidogrel 75mg',
        'product_code' => 'KP-CV-010',
        'category' => 'Cardiovascular',
        'description' => 'Antiplatelet agent for stroke and heart attack prevention. Used after stent placement.',
        'price' => 52.75,
        'stock_quantity' => 3200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Nitroglycerin 0.5mg',
        'product_code' => 'KP-CV-011',
        'category' => 'Cardiovascular',
        'description' => 'Fast-acting vasodilator for acute angina relief. Sublingual tablet for immediate effect.',
        'price' => 28.50,
        'stock_quantity' => 4400,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Digoxin 0.25mg',
        'product_code' => 'KP-CV-012',
        'category' => 'Cardiovascular',
        'description' => 'Cardiac glycoside for heart failure and atrial fibrillation management. Increases heart contractility.',
        'price' => 38.00,
        'stock_quantity' => 3400,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),

    // Vitamins Category
    array(
        'product_name' => 'Vitamin D3 1000 IU',
        'product_code' => 'KP-VM-001',
        'category' => 'Vitamins',
        'description' => 'Essential for bone health and calcium absorption. Supports immune system function.',
        'price' => 16.99,
        'stock_quantity' => 6000,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Vitamin B12 1000mcg',
        'product_code' => 'KP-VM-002',
        'category' => 'Vitamins',
        'description' => 'Energy and nerve function support. Essential for vegetarians and elderly individuals.',
        'price' => 24.50,
        'stock_quantity' => 4500,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Vitamin C 500mg',
        'product_code' => 'KP-VM-003',
        'category' => 'Vitamins',
        'description' => 'Immune system booster and antioxidant. Supports collagen formation and wound healing.',
        'price' => 18.75,
        'stock_quantity' => 5200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Multivitamin Complex',
        'product_code' => 'KP-VM-004',
        'category' => 'Vitamins',
        'description' => 'Complete daily vitamin and mineral supplementation. Contains essential nutrients for overall health.',
        'price' => 32.00,
        'stock_quantity' => 4800,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Folic Acid 400mcg',
        'product_code' => 'KP-VM-005',
        'category' => 'Vitamins',
        'description' => 'Essential for pregnant women and cell division. Prevents birth defects and supports healthy development.',
        'price' => 14.99,
        'stock_quantity' => 5800,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Vitamin E 400 IU',
        'product_code' => 'KP-VM-006',
        'category' => 'Vitamins',
        'description' => 'Powerful antioxidant for skin health and cellular protection. Supports cardiovascular function.',
        'price' => 28.50,
        'stock_quantity' => 4200,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Vitamin A 10000 IU',
        'product_code' => 'KP-VM-007',
        'category' => 'Vitamins',
        'description' => 'Supports vision and eye health. Essential for immune function and skin condition improvement.',
        'price' => 19.99,
        'stock_quantity' => 5000,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Vitamin B Complex',
        'product_code' => 'KP-VM-008',
        'category' => 'Vitamins',
        'description' => 'Complete B-complex for energy metabolism and nerve function. Contains B1, B2, B3, B5, B6, B12, and Biotin.',
        'price' => 26.75,
        'stock_quantity' => 4600,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Calcium 500mg',
        'product_code' => 'KP-VM-009',
        'category' => 'Vitamins',
        'description' => 'Supports bone strength and dental health. Essential for muscle and nerve function.',
        'price' => 15.50,
        'stock_quantity' => 5400,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Iron 65mg',
        'product_code' => 'KP-VM-010',
        'category' => 'Vitamins',
        'description' => 'Prevents anemia and supports red blood cell formation. Especially important for women.',
        'price' => 17.25,
        'stock_quantity' => 4900,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Zinc 15mg',
        'product_code' => 'KP-VM-011',
        'category' => 'Vitamins',
        'description' => 'Immune system booster and antioxidant. Supports wound healing and protein synthesis.',
        'price' => 20.99,
        'stock_quantity' => 4700,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    ),
    array(
        'product_name' => 'Omega-3 Fish Oil 1000mg',
        'product_code' => 'KP-VM-012',
        'category' => 'Vitamins',
        'description' => 'Rich in EPA and DHA for heart and brain health. Supports healthy cholesterol levels.',
        'price' => 35.50,
        'stock_quantity' => 4300,
        'manufacturer' => 'KHAN Pharmaceuticals PLC.'
    )
);

// Insert data into database
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $inserted = 0;
    $skipped = 0;
    
    foreach ($medicines as $medicine) {
        // Check if product already exists
        $check_sql = "SELECT id FROM products WHERE product_code = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $medicine['product_code']);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows === 0) {
            // Insert new product
            $insert_sql = "INSERT INTO products (product_name, product_code, category, description, price, stock_quantity, manufacturer, status) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, 'active')";
            $stmt = $conn->prepare($insert_sql);
            
            if (!$stmt) {
                echo "Prepare failed: " . $conn->error . "<br>";
                continue;
            }
            
            $stmt->bind_param(
                "ssssidi",
                $medicine['product_name'],
                $medicine['product_code'],
                $medicine['category'],
                $medicine['description'],
                $medicine['price'],
                $medicine['stock_quantity'],
                $medicine['manufacturer']
            );
            
            if ($stmt->execute()) {
                $inserted++;
                echo "✓ Inserted: " . htmlspecialchars($medicine['product_name']) . "<br>";
            } else {
                echo "✗ Failed to insert: " . htmlspecialchars($medicine['product_name']) . " - " . $stmt->error . "<br>";
            }
            $stmt->close();
        } else {
            $skipped++;
            echo "⊘ Skipped (already exists): " . htmlspecialchars($medicine['product_name']) . "<br>";
        }
        $check_stmt->close();
    }
    
    echo "<hr>";
    echo "<strong>Summary:</strong><br>";
    echo "Inserted: " . $inserted . " medicines<br>";
    echo "Skipped: " . $skipped . " medicines (already exist)<br>";
    echo "<br><a href='products.php'>View Products</a>";
    
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn) && is_object($conn)) {
        $conn->close();
    }
}
?>
