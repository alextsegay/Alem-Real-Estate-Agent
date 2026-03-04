<?php
session_start();
$password = "Addis2024"; 

// Login/Logout Logic
if (isset($_POST['login_pass']) && $_POST['login_pass'] == $password) { $_SESSION['auth'] = true; }
if (isset($_GET['logout'])) { session_destroy(); header("Location: add.php"); exit; }
$auth = isset($_SESSION['auth']);

// Delete Logic
if ($auth && isset($_GET['delete'])) {
    $data = json_decode(file_get_contents('data.json'), true) ?: [];
    $new_data = array_filter($data, function($item) { return $item['id'] != $_GET['delete']; });
    file_put_contents('data.json', json_encode(array_values($new_data), JSON_PRETTY_PRINT));
    header("Location: add.php"); exit;
}

// Upload Logic
if ($auth && isset($_POST['submit_property'])) {
    $images = [];
    if (!is_dir('uploads')) mkdir('uploads', 0755);
    foreach ($_FILES['photos']['name'] as $k => $name) {
        if ($_FILES['photos']['tmp_name'][$k]) {
            $path = "uploads/" . time() . "_" . basename($name);
            move_uploaded_file($_FILES['photos']['tmp_name'][$k], $path);
            $images[] = $path;
        }
    }
    $data = json_decode(file_get_contents('data.json'), true) ?: [];
    $data[] = [
        "id" => time(),
        "title" => $_POST['title'], "price" => $_POST['price'], "location" => $_POST['location'],
        "type" => $_POST['type'], "status" => $_POST['status'], 
        "beds" => $_POST['beds'], "baths" => $_POST['baths'], "sqm" => $_POST['sqm'],
        "images" => $images, "desc" => $_POST['desc'],
        "phone" => $_POST['phone'], "wa" => $_POST['wa'], "tele" => $_POST['tele'], "map" => $_POST['map'],
        // --- NEW FIELDS ---
        "video" => $_POST['video'], 
        "amenities" => $_POST['amenities'],
        "featured" => $_POST['featured']
    ];
    file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
    header("Location: index.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard | Elite Addis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --accent: #D4AF37; --bg: #0f0f0f; --panel: #1a1a1a; }
        body { background: var(--bg); font-family: 'Inter', sans-serif; color: #fff; }
        .admin-nav { display: flex; justify-content: space-between; align-items: center; padding: 20px; background: var(--panel); border-bottom: 1px solid #333; margin-bottom: 30px; }
        .glass-card { background: var(--panel); border: 1px solid #333; border-radius: 15px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        label { display: block; color: var(--accent); font-size: 11px; font-weight: bold; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;}
        input, select, textarea { width: 100%; padding: 12px; background: #000; border: 1px solid #333; color: #fff; border-radius: 8px; margin-bottom: 20px; box-sizing: border-box; font-size: 14px;}
        input:focus { border-color: var(--accent); outline: none; }
        .btn-primary { background: var(--accent); color: #000; padding: 15px; border: none; border-radius: 8px; font-weight: bold; width: 100%; cursor: pointer; font-size: 16px; text-transform: uppercase; letter-spacing: 1px;}
        .listing-item { background: #111; border: 1px solid #222; padding: 15px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<?php if (!$auth): ?>
    <div style="max-width: 400px; margin: 100px auto;" class="glass-card">
        <h2 style="text-align: center; color: var(--accent);">SECURITY CHECK</h2>
        <form method="POST">
            <input type="password" name="login_pass" placeholder="Enter Access Key" required>
            <button class="btn-primary">UNLOCK DASHBOARD</button>
        </form>
    </div>
<?php else: ?>
    <nav class="admin-nav">
        <h1 style="font-size: 18px; letter-spacing: 2px;">ELITE <span style="color:var(--accent)">DASHBOARD</span></h1>
        <a href="?logout=1" style="color: #ff4444; text-decoration: none; font-weight: bold; font-size: 14px;">Logout</a>
    </nav>

    <div class="container" style="max-width: 900px; margin: auto; padding: 0 20px;">
        <div class="glass-card">
            <h2 style="margin-top: 0; margin-bottom: 25px; border-left: 4px solid var(--accent); padding-left: 15px;">Add New Property</h2>
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form-grid">
                    <div>
                        <label>Listing Title</label>
                        <input type="text" name="title" placeholder="Modern Villa in Bole" required>
                    </div>
                    <div>
                        <label>Price</label>
                        <input type="text" name="price" placeholder="45,000,000 ETB" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label>Property Purpose</label>
                        <select name="type">
                            <option value="For Sale">🏠 For Sale</option>
                            <option value="For Rent">🔑 For Rent</option>
                        </select>
                    </div>
                    <div>
                        <label>Set as Featured?</label>
                        <select name="featured">
                            <option value="no">Normal Listing</option>
                            <option value="yes">⭐ Featured (Homepage)</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                   <div>
                        <label>Availability Status</label>
                        <select name="status">
                            <option value="Available">🟢 Available</option>
                            <option value="Sold/Rented">🔴 Sold / Rented</option>
                        </select>
                    </div>
                    <div>
                        <label>Location</label>
                        <input type="text" name="location" placeholder="Addis Ababa, Bole Atlas..." required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                    <div><label>Beds</label><input type="number" name="beds" placeholder="0"></div>
                    <div><label>Baths</label><input type="number" name="baths" placeholder="0"></div>
                    <div><label>Sqm</label><input type="number" name="sqm" placeholder="0"></div>
                </div>

                <label>Amenities (Comma separated)</label>
                <input type="text" name="amenities" placeholder="WiFi, Gated, Generator, Parking...">

                <label>Video Tour URL (YouTube/TikTok)</label>
                <input type="text" name="video" placeholder="Paste link here">

                <label>Property Images</label>
                <input type="file" name="photos[]" multiple required style="background: #111; padding: 10px;">

                <label>Description</label>
                <textarea name="desc" rows="4" placeholder="Describe the luxury features..."></textarea>

                <label>Google Maps Iframe Code</label>
                <input type="text" name="map" placeholder="Paste <iframe> code from Google Maps">

                <h3 style="color: var(--accent); margin: 20px 0 10px; font-size: 16px;">Contact Integration</h3>
                <div class="form-grid">
                    <input type="text" name="phone" placeholder="Phone Number">
                    <input type="text" name="wa" placeholder="WhatsApp (2519...)">
                </div>
                <input type="text" name="tele" placeholder="Telegram Username Link">

                <button name="submit_property" class="btn-primary">PUBLISH LISTING</button>
            </form>
        </div>

        <div style="margin: 50px 0;">
            <h2 style="color: var(--accent); font-size: 20px; margin-bottom: 20px;">Current Inventory</h2>
            <?php 
            $list = json_decode(file_get_contents('data.json'), true) ?: [];
            foreach (array_reverse($list) as $item): ?>
                <div class="listing-item">
                    <div style="font-size: 14px;">
                        <span style="color: var(--accent);"><?php echo $item['type']; ?></span> | 
                        <strong><?php echo $item['title']; ?></strong>
                    </div>
                    <a href="?delete=<?php echo $item['id']; ?>" style="color: #ff4444; text-decoration: none; font-size: 12px; font-weight: bold;" onclick="return confirm('Permanently delete this listing?')">
                        <i class="fa-solid fa-trash-can"></i> REMOVE
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>