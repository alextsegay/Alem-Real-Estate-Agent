<?php 
// 1. Load Data
$properties = json_decode(file_get_contents('data.json'), true) ?: [];
$properties = array_reverse($properties); // Newest first

// 2. Count for the header
$total_count = count($properties);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Properties | Elite Addis Real Estate</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container" style="padding: 60px 0;">
        <div style="margin-bottom: 40px; border-left: 4px solid var(--gold); padding-left: 20px;">
            <h1 style="margin: 0; font-size: 2.5rem;">OUR <span style="color: var(--gold);">LISTINGS</span></h1>
            <p style="color: #888; margin: 5px 0;">Showing <?php echo $total_count; ?> premium properties across Addis Ababa.</p>
        </div>

        <div class="grid">
            <?php foreach ($properties as $p): ?>
                <a href="property.php?id=<?php echo $p['id']; ?>" class="card">
                    <div class="badge" style="background: #fff; color: #000; top: 15px; left: 15px;">
                        <?php echo $p['type'] ?? 'For Sale'; ?>
                    </div>
                    
                    <?php if(($p['status'] ?? '') == 'Sold/Rented'): ?>
                        <div class="badge status-sold" style="top: 15px; right: 15px; left: auto;">SOLD / RENTED</div>
                    <?php endif; ?>

                    <img src="<?php echo $p['images'][0]; ?>" class="card-img" alt="<?php echo $p['title']; ?>">
                    
                    <div class="card-body">
                        <div class="price"><?php echo $p['price']; ?></div>
                        <h3 style="margin: 10px 0; font-size: 1.2rem;"><?php echo $p['title']; ?></h3>
                        <p style="color:#888; font-size: 14px; margin-bottom: 15px;">📍 <?php echo $p['location']; ?></p>
                        
                        <div style="display: flex; gap: 10px; border-top: 1px solid #222; padding-top: 15px; color: #666; font-size: 12px;">
                            <span>🛏️ <?php echo $p['beds']; ?></span>
                            <span>🚿 <?php echo $p['baths']; ?></span>
                            <span>📐 <?php echo $p['sqm']; ?> m²</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

            <?php if($total_count == 0): ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                    <p style="color: #666;">No properties found. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>