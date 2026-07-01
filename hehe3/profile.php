<?php
require_once 'includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = cleanInput($_POST['name']);
    $phone = cleanInput($_POST['phone']);
    $address = cleanInput($_POST['address']);
    
    $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$name, $phone, $address, $user_id]);
    $success = "Profile updated successfully!";
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">My Profile</h1>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <div class="card shadow-lg">
            <div class="card-body p-5">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>