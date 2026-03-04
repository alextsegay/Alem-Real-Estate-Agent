<?php 
// 1. Load and Reverse Data (Newest First)
$all_properties = json_decode(file_get_contents('data.json'), true) ?: [];
$all_properties = array_reverse($all_properties); 

// 2. THE LOGIC FIX: Filter for properties specifically marked 'yes' for featured
$featured = array_filter($all_properties, function($p) {
    return isset($p['featured']) && $p['featured'] === 'yes';
});
$featured = array_slice($featured, 0, 3); // Top 3 Featured

// 3. Filter for regular properties (Not Featured) to show in "Latest"
$recent = array_filter($all_properties, function($p) {
    return !isset($p['featured']) || $p['featured'] !== 'yes';
});
$recent = array_slice($recent, 0, 6); // Top 6 Recent
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Addis | Luxury Real Estate Ethiopia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --gold: #D4AF37; --dark: #0a0a0a; --card: #111; }
        
        /* Hero Section */
        .hero {
            height: 85vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://www.magicalgorillaadventures.com/wp-content/uploads/2024/07/3-Day-Addis-Ababa-Surroundings-Tour-Explore-Ethiopias-Capital-Debre-Libanos-Monastery-Menagesha-Suba-Forest.jpg');
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center; text-align: center; color: #fff;
        }
        .hero-content h1 { font-size: clamp(2rem, 8vw, 4rem); letter-spacing: 2px; margin: 10px 0 30px; font-weight: 900; }
        .hero-content p { color: var(--gold); text-transform: uppercase; letter-spacing: 4px; font-weight: bold; }
        
        /* Grid & Cards */
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-top: 20px; }
        .card { background: var(--card); border-radius: 15px; overflow: hidden; border: 1px solid #222; text-decoration: none; color: inherit; transition: 0.3s; position: relative; }
        .card:hover { transform: translateY(-10px); border-color: var(--gold); }
        
        .card-img { width: 100%; height: 240px; object-fit: cover; }
        .card-body { padding: 20px; }
        .price { font-size: 1.5rem; color: #fff; font-weight: 800; }
        
        /* Badges */
        .badge-featured { position: absolute; top: 15px; left: 15px; background: var(--gold); color: #000; padding: 5px 12px; font-size: 11px; font-weight: 900; border-radius: 5px; z-index: 10; }
        .badge-type { position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.8); color: var(--gold); padding: 5px 12px; font-size: 11px; font-weight: bold; border-radius: 5px; z-index: 10; border: 1px solid var(--gold); }
        
        .section-title { text-align: center; margin: 80px 0 40px; }
        .section-title h2 { font-size: 2.2rem; letter-spacing: 2px; text-transform: uppercase; }
        .line { width: 60px; height: 3px; background: var(--gold); margin: 15px auto; }

        @media (max-width: 768px) {
            .hero { height: 60vh; }
            .section-title h2 { font-size: 1.6rem; }
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <p>Modern Living In The Capital</p>
            <h1>FIND YOUR LUXURY</h1>
            <a href="properties.php" class="cta-btn" style="padding: 15px 40px; background: var(--gold); color: #000; text-decoration: none; font-weight: bold; border-radius: 5px;">EXPLORE LISTINGS</a>
        </div>
    </section>

    <div class="container">
        
        <?php if(!empty($featured)): ?>
        <div class="section-title">
            <h2>FEATURED <span style="color:var(--gold)">PROPERTIES</span></h2>
            <div class="line"></div>
        </div>

        <div class="grid">
            <?php foreach ($featured as $p): ?>
                <a href="property.php?id=<?php echo $p['id']; ?>" class="card">
                    <div class="badge-featured">⭐ FEATURED</div>
                    <div class="badge-type"><?php echo strtoupper($p['type']); ?></div>
                    
                    <img src="<?php echo $p['images'][0]; ?>" class="card-img">
                    
                    <div class="card-body">
                        <div class="price"><?php echo $p['price']; ?></div>
                        <h3 style="margin: 10px 0; font-size: 1.2rem;"><?php echo $p['title']; ?></h3>
                        <p style="color:#888; font-size: 14px;"><i class="fa-solid fa-location-dot"></i> <?php echo $p['location']; ?></p>
                        
                        <div style="display: flex; gap: 15px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #222; font-size: 13px; color: #ccc;">
                            <span><i class="fa-solid fa-bed"></i> <?php echo $p['beds']; ?></span>
                            <span><i class="fa-solid fa-bath"></i> <?php echo $p['baths']; ?></span>
                            <span><i class="fa-solid fa-vector-square"></i> <?php echo $p['sqm']; ?>m²</span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="section-title">
            <h2>LATEST <span style="color:var(--gold)">LISTINGS</span></h2>
            <div class="line"></div>
        </div>

        <div class="grid">
            <?php foreach ($recent as $p): ?>
                <a href="property.php?id=<?php echo $p['id']; ?>" class="card">
                    <div class="badge-type" style="background: rgba(255,255,255,0.1); color: #fff; border: 1px solid #444;"><?php echo strtoupper($p['type']); ?></div>
                    
                    <img src="<?php echo $p['images'][0]; ?>" class="card-img">
                    
                    <div class="card-body">
                        <div class="price"><?php echo $p['price']; ?></div>
                        <h3 style="margin: 10px 0; font-size: 1.2rem;"><?php echo $p['title']; ?></h3>
                        <p style="color:#888; font-size: 14px;"><i class="fa-solid fa-location-dot"></i> <?php echo $p['location']; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="section-title" style="margin-top: 100px;">
            <h2>OUR <span style="color:var(--gold)">SERVICES</span></h2>
            <div class="line"></div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 80px;">
            <div style="background: #111; padding: 40px; border-radius: 15px; border: 1px solid #222; text-align: center;">
                <i class="fa-solid fa-city" style="font-size: 2.5rem; color: var(--gold); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 10px;">Property Sales</h3>
                <p style="color: #777; font-size: 14px; line-height: 1.6;">Premium villas and apartments across the most exclusive neighborhoods in Addis.</p>
            </div>
            <div style="background: #111; padding: 40px; border-radius: 15px; border: 1px solid #222; text-align: center;">
                <i class="fa-solid fa-key" style="font-size: 2.5rem; color: var(--gold); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 10px;">Luxury Rentals</h3>
                <p style="color: #777; font-size: 14px; line-height: 1.6;">Fully managed rental solutions for diplomats and international professionals.</p>
            </div>
            <div style="background: #111; padding: 40px; border-radius: 15px; border: 1px solid #222; text-align: center;">
                <i class="fa-solid fa-file-shield" style="font-size: 2.5rem; color: var(--gold); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 10px;">Legal Consulting</h3>
                <p style="color: #777; font-size: 14px; line-height: 1.6;">Expert guidance on Ethiopian property laws and secure title deed transfers.</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>