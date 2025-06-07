<?php
require_once 'Database.php';
require_once 'User.php';
require_once 'UserManager.php';

$db = new Database();
$userManager = new UserManager($db->getConnection());

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $message = "❗ Passwords do not match.";
    } elseif ($userManager->userExists($username)) {
        $message = "❗ Username already exists.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($username, $hashedPassword);

        if ($userManager->register($user)) {
            header("Location: index.php");
            exit;
        } else {
            $message = "❗ Registration failed.";
        }
    }
}
?>

<?php include 'header.php'; ?>

<div class="container tm-mt-big tm-mb-big">
  <div class="row">
    <div class="col-12 mx-auto tm-login-col">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="tm-block-title mb-4">Create Account</h2>
            <?php if (!empty($message)): ?>
              <p style="color: #ff9999;"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <form action="register.php" method="post" class="tm-login-form">
              <div class="form-group">
                <label for="username">Username</label>
                <input name="username" type="text" class="form-control validate" id="username" required />
              </div>
              <div class="form-group mt-3">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control validate" id="email" required />
              </div>
              <div class="form-group mt-3">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control validate" id="password" required />
              </div>
              <div class="form-group mt-3">
                <label for="confirm_password">Confirm Password</label>
                <input name="confirm_password" type="password" class="form-control validate" id="confirm_password" required />
              </div>
              <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
