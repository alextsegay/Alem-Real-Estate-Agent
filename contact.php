<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Our Agents | Elite Addis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .contact-section { padding: 100px 0; background: #0a0a0a; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 60px; }
        
        /* Form Styling */
        .premium-form { background: #111; padding: 40px; border-radius: 20px; border: 1px solid #222; }
        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; color: var(--gold); font-size: 11px; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 10px; }
        .input-group input, .input-group select, .input-group textarea {
            width: 100%; padding: 15px; background: #050505; border: 1px solid #333; color: #fff; border-radius: 8px; transition: 0.3s;
        }
        .input-group input:focus { border-color: var(--gold); outline: none; background: #0a0a0a; }

        /* The Professional Button */
        .submit-btn {
            width: 100%; padding: 20px; background: var(--gold); color: #000; border: none; border-radius: 8px;
            font-weight: 800; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: 0.4s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .submit-btn:hover { background: #fff; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2); }

        /* Info Boxes */
        .contact-method { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
        .icon-circle { width: 50px; height: 50px; background: #1a1a1a; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--gold); border: 1px solid #333; }
        
        @media (max-width: 900px) { .contact-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<?php include 'header.php'; // Ensure your nav is in a separate file or paste here ?>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            
            <div>
                <h1 style="font-size: 3.5rem; line-height: 1; margin-bottom: 30px;">LET'S <span style="color:var(--gold)">TALK</span></h1>
                <p style="color: #777; margin-bottom: 50px;">Our agents are ready to assist you in finding the perfect property in Addis Ababa.</p>
                
                <div class="contact-method">
                    <div class="icon-circle"><i class="fas fa-phone"></i></div>
                    <div><h4 style="margin:0; color:#fff;">Phone</h4><p style="margin:0; color:#888;">+251 911 00 00 00</p></div>
                </div>

                <div class="contact-method">
                    <div class="icon-circle"><i class="fab fa-whatsapp"></i></div>
                    <div><h4 style="margin:0; color:#fff;">WhatsApp</h4><p style="margin:0; color:#888;">Chat Instantly</p></div>
                </div>

                <div class="contact-method">
                    <div class="icon-circle"><i class="fas fa-envelope"></i></div>
                    <div><h4 style="margin:0; color:#fff;">Email</h4><p style="margin:0; color:#888;">info@eliteaddis.com</p></div>
                </div>
            </div>

            <div class="premium-form">
                <form id="proContactForm">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" id="name" placeholder="John Doe" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="input-group">
                            <label>Property Interest</label>
                            <select id="property_type">
                                <option>Luxury Villa</option>
                                <option>Apartment</option>
                                <option>Commercial Space</option>
                                <option>Land / Plot</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Budget Range (ETB)</label>
                            <select id="budget">
                                <option>10M - 30M</option>
                                <option>30M - 60M</option>
                                <option>60M - 100M+</option>
                                <option>Rental (Monthly)</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Your Message</label>
                        <textarea id="message" rows="5" placeholder="Tell us more about what you are looking for..." required></textarea>
                    </div>

                    <button type="button" onclick="sendToWhatsApp()" class="submit-btn">
                        SEND ENQUIRY <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function sendToWhatsApp() {
    const name = document.getElementById('name').value;
    const type = document.getElementById('property_type').value;
    const budget = document.getElementById('budget').value;
    const msg = document.getElementById('message').value;
    
    const phone = "251911000000"; // Client's Phone
    
    const text = `*New Property Inquiry*%0A` +
                 `*Name:* ${name}%0A` +
                 `*Interest:* ${type}%0A` +
                 `*Budget:* ${budget}%0A` +
                 `*Message:* ${msg}`;

    window.open(`https://wa.me/${phone}?text=${text}`, '_blank');
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>