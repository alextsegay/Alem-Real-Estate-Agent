<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --gold: #D4AF37;
        --nav-bg: rgba(10, 10, 10, 0.98);
    }

    /* Navbar Container */
    nav {
        position: fixed;
        top: 0; width: 100%;
        background: var(--nav-bg);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid #222;
        z-index: 3000;
        padding: 15px 0;
    }

    .nav-container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        color: var(--gold);
        text-decoration: none;
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Desktop Links */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        transition: 0.3s;
    }

    .nav-links a:hover { color: var(--gold); }

    /* Mobile Menu Icon */
    .menu-toggle {
        display: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
    }

    /* Mobile Menu Dropdown */
    .mobile-menu {
        display: none;
        position: fixed;
        top: 70px; /* Right under nav */
        left: 0;
        width: 100%;
        background: #111;
        border-bottom: 2px solid var(--gold);
        padding: 20px 0;
        z-index: 2500;
        text-align: center;
        flex-direction: column;
        gap: 20px;
    }

    .mobile-menu a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        display: block;
        padding: 10px 0;
    }

    /* Screen Size Logic */
    @media (max-width: 850px) {
        .nav-links { display: none; }
        .menu-toggle { display: block; }
        .mobile-menu.active { display: flex; }
    }

    .nav-spacer { height: 75px; }
</style>

<nav>
    <div class="nav-container">
        <a href="index.php" class="logo">ELITE ADDIS</a>
        
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="properties.php">Properties</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars" id="menuIcon"></i>
        </div>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="index.php" onclick="toggleMenu()">Home</a>
    <a href="properties.php" onclick="toggleMenu()">Properties</a>
    <a href="about.php" onclick="toggleMenu()">About Us</a>
    <a href="contact.php" onclick="toggleMenu()">Contact</a>
    <a href="add.php" onclick="toggleMenu()" style="color: var(--gold);">Agent Login</a>
</div>

<div class="nav-spacer"></div>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        
        menu.classList.toggle('active');
        
        // Change icon from Bars to X when open
        if (menu.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
</script>