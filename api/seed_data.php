<?php
// api/seed_data.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/db.php";

// Clear existing data to ensure fresh seed
$conn->query("SET FOREIGN_KEY_CHECKS = 0");
$conn->query("TRUNCATE TABLE equipment");
$conn->query("SET FOREIGN_KEY_CHECKS = 1");
echo "Table truncated.\n";

$statements = [
    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('JCB-Backhoe Loader', 'Versatile JCB for digging and loading Operations', '- 4WD / 2WD\n- Hydraulic System\n- Multiple Attachements', 9000.00, 'Earthmoving', 'jcb_backhoe_loader_real_image.webp', 1)",
    
    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Tractor', 'Powerful tractor suitable for heavy construction work', '- 50 HP Engine\n- Air Conditioned Cabin\n- Fuel Efficient', 5000.00, 'Agriculture', 'tractor_real_image.webp', 1)",
    
    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Self Loading Concrete Mixer', 'Capable of automatically loading raw materials into concrete mixer', '- 6000 Litre concrete mixer\n- High Pressure cleaning\n- Easy to operate', 12000.00, 'Concrete', 'self_loading_concerete_mixer_real_image.webp', 1)",
    
    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Excavator', 'Heavy-duty steel tracks or rubber tracks provide stability and mobility on rough or uneven surfaces.', '- Rotates 360 degree\n- High Pressure in working system\n- Provides vertical reach and lift.\n- High Demand', 15000.00, 'Earthmoving', 'excavator_real_image.jpg', 0)",

    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Mini Excavator', 'Lightweight version of a standard excavator,', '- Utility and Pipeline Work\n- Compact size and easy transport\n- Easy to operate and maintain\n- Can work in confined or indoor areas', 9000.00, 'Earthmoving', 'mini_excavator_real_image.webp', 1)",

    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Tipper Lorry', 'High-capacity tipper for material transportation', '- 10 Ton Capacity\n- Hydraulic Tipper', 10000.00, 'Transport', 'tipper_lorry_real_image.jpg', 1)",

    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Water tanker', 'A vehicle designed to store, transport, and distribute water', '- 6000 Liters Capacity Tanker\n- Anti-corrosive paint (inside & outside)\n- Front spray nozzles for road washing\n- Rear sprinklers for dust suppression', 2000.00, 'Transport', 'water_tanker_real_image.webp', 1)",

    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Skid Loader', 'Lift arms that can attach to a wide variety of a tools or attachments.', '- Easy to control\n- Easy transport between sites\n- Durable and low maintenance', 12000.00, 'Earthmoving', 'skid_loader_real_image.webp', 1)",

    "INSERT INTO equipment (name, description, highlights, price_per_day, category, image_url, availability) VALUES 
    ('Ready Mix Concrete Truck', 'Transport pre-mixed concrete from batch plant to construction site', '- keeping it agitated in its rotating drum to prevent setting until it\'s discharged for use in foundations\n- Saves time and labor compared to site-mixed concrete.\n- Ensures consistent mix design and quality control.', 15000.00, 'Concrete', 'rmc_truck_real_image.jpg', 1)"
];

foreach ($statements as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Inserted record successfully.<br>";
    } else {
        echo "Error inserting record: " . $conn->error . "<br>";
    }
}
echo "Data seeding complete.";
?>
