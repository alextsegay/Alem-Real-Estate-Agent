<?php 
$data = json_decode(file_get_contents('data.json'), true) ?: [];
$id = $_GET['id'] ?? null; $p = null;
foreach($data as $item) { if($item['id'] == $id) { $p = $item; break; } }
if (!$p) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $p['title']; ?> | Elite Addis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --gold: #D4AF37; --bg: #0a0a0a; --card: #161616; }
        body { background: var(--bg); color: #fff; font-family: 'Inter', sans-serif; }
        
        /* Featured Ribbon */
        .featured-ribbon {
            position: absolute; top: 20px; left: 0;
            background: var(--gold); color: #000;
            padding: 5px 20px; font-weight: 900; font-size: 12px;
            letter-spacing: 1px; border-radius: 0 5px 5px 0;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5); z-index: 10;
        }

        .img-container { position: relative; width: 100%; margin-top: 20px; }
        .main-img { width: 100%; height: 500px; object-fit: cover; border-radius: 15px; border: 1px solid #222; }
        .thumb-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 15px; }
        .thumb-grid img { width: 100%; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; opacity: 0.6; transition: 0.3s; border: 2px solid transparent; }
        .thumb-grid img:hover { opacity: 1; border-color: var(--gold); }

        .specs { display: flex; gap: 20px; margin: 25px 0; background: var(--card); padding: 20px; border-radius: 12px; border: 1px solid #222; }
        .spec-item { font-weight: bold; font-size: 15px; display: flex; align-items: center; gap: 8px; }
        
        /* Mobile Repairs */
        @media (max-width: 768px) {
            .main-img { height: 300px; }
            .specs { display: grid; grid-template-columns: 1fr 1fr; }
            .price { font-size: 1.8rem !important; }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container" style="padding-top:30px;">
        <a href="index.php" style="color:var(--gold); text-decoration:none; font-weight:bold; font-size: 14px;">← BACK</a>

        <div class="img-container">
            <?php if(isset($p['featured']) && $p['featured'] == 'yes'): ?>
                <div class="featured-ribbon">⭐ FEATURED PROPERTY</div>
            <?php endif; ?>

            <img id="main-view" src="<?php echo $p['images'][0]; ?>" class="main-img">
        </div>

        <div class="thumb-grid">
            <?php foreach($p['images'] as $img): ?>
                <img src="<?php echo $img; ?>" onclick="document.getElementById('main-view').src=this.src">
            <?php endforeach; ?>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-top:30px; flex-wrap:wrap;">
            <div>
                <span style="color:var(--gold); font-weight:bold; letter-spacing:1px; font-size:12px; text-transform:uppercase;">
                    <?php echo $p['type']; ?>
                </span>
                <h1 style="margin:5px 0 0 0;"><?php echo $p['title']; ?></h1>
                <p style="color:#888;"><i class="fa-solid fa-location-dot"></i> <?php echo $p['location']; ?></p>
            </div>
            <div style="text-align:right;">
                <div class="price" style="font-size:2.5rem; color:#fff; font-weight:800;">
                    <?php echo $p['price']; ?>
                    <span style="font-size:14px; color:#888; font-weight:normal;">
                        <?php echo ($p['type'] == 'For Rent') ? '/ month' : ''; ?>
                    </span>
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:5px;">
                    <span style="background:<?php echo ($p['status'] == 'Available') ? '#2ecc71' : '#e74c3c'; ?>; color:#fff; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight:bold;">
                        <?php echo strtoupper($p['status']); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="specs">
            <div class="spec-item"><i class="fa-solid fa-bed" style="color:var(--gold)"></i> <?php echo $p['beds']; ?> Beds</div>
            <div class="spec-item"><i class="fa-solid fa-bath" style="color:var(--gold)"></i> <?php echo $p['baths']; ?> Baths</div>
            <div class="spec-item"><i class="fa-solid fa-ruler-combined" style="color:var(--gold)"></i> <?php echo $p['sqm']; ?> m²</div>
            <div class="spec-item"><i class="fa-solid fa-tag" style="color:var(--gold)"></i> <?php echo $p['type']; ?></div>
        </div>

        <p style="color:#ccc; line-height:1.7;"><?php echo nl2br($p['desc']); ?></p>

        <div class="btn-group" style="margin-top: 40px; display: flex; gap: 15px; margin-bottom:100px;">
            <a href="tel:<?php echo $p['phone']; ?>" class="btn" style="background:var(--gold); color:#000; flex:1; text-align:center; padding:15px; border-radius:10px; font-weight:bold; text-decoration:none;">CALL AGENT</a>
            <a href="https://wa.me/<?php echo $p['wa']; ?>" class="btn" style="background:#25D366; color:#fff; flex:1; text-align:center; padding:15px; border-radius:10px; font-weight:bold; text-decoration:none;">WHATSAPP</a>
            <a href="https://t.me/<?php echo $p['tele']; ?>" class="btn" style="background:#0088CC; color:#fff; flex:1; text-align:center; padding:15px; border-radius:10px; font-weight:bold; text-decoration:none;">TELEGRAM</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>