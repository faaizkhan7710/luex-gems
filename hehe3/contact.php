<?php
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $subject = cleanInput($_POST['subject']);
    $message = cleanInput($_POST['message']);
    
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $subject, $message]);
    $success = "Thank you for your message! We'll get back to you soon.";
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">Contact Us</h1>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <h5>Get In Touch</h5>
                <p><strong>Email:</strong> info@luxegems.com</p>
                <p><strong>Phone:</strong> +1 234 567 890</p>
                <p><strong>Address:</strong> 123 Luxury Ave, Fashion City</p>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>