<?php
session_start();
require_once 'backend/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student';

    try {
        $table = ($role === 'admin') ? 'admins' : 'students';
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Vérification sans password_verify (texte brut)
        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $user['email'];
            
            // Redirection selon le rôle
            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Portail Étudiant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles/login.css">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Left Side (Form) -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-5">
                <div class="w-100" style="max-width: 500px;">
                    <div class="text-center mb-5">
                        <img src="assets/img/logo.png" alt="Logo" class="mb-4" style="height: 80px;">
                        <h1 class="h3 fw-bold">Connexion</h1>
                        <p class="text-muted">Accédez à votre espace personnel</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form id="loginForm" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="email" class="form-label">Adresse Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required placeholder="votre@email.com">
                                <div class="invalid-feedback">
                                    Veuillez entrer une adresse email valide.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="••••••••">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre mot de passe.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Vous êtes :</label>
                            <div class="d-flex gap-3">
                                <div class="form-check flex-grow-1">
                                    <input class="form-check-input" type="radio" name="role" id="student" value="student" checked>
                                    <label class="form-check-label d-flex align-items-center gap-2" for="student">
                                        <i class="fas fa-user-graduate"></i> Étudiant
                                    </label>
                                </div>
                                <div class="form-check flex-grow-1">
                                    <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                                    <label class="form-check-label d-flex align-items-center gap-2" for="admin">
                                        <i class="fas fa-user-shield"></i> Administrateur
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-primary btn-lg shadow" type="submit">
                                <span class="me-2">Se connecter</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side (Carousel) -->
            <div class="col-lg-6 d-none d-lg-block p-0">
                <div id="loginCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100" style="background-image: url('assets/img/login-bg1.jpg'); background-size: cover;">
                            <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="background-color: rgba(0,0,0,0.5);">
                                <h2>Portail Étudiant</h2>
                                <p>Accédez à toutes vos ressources académiques</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('assets/img/login-bg2.jpg'); background-size: cover;">
                            <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="background-color: rgba(0,0,0,0.5);">
                                <h2>Projets Innovants</h2>
                                <p>Découvrez les projets de fin d'études</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('assets/img/login-bg3.jpg'); background-size: cover;">
                            <div class="carousel-caption d-flex flex-column justify-content-center h-100" style="background-color: rgba(0,0,0,0.5);">
                                <h2>Ressources Pédagogiques</h2>
                                <p>Tous vos cours en ligne</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Réinitialisation du mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label for="recoveryEmail" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="recoveryEmail" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="sendRecoveryBtn">Envoyer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="scripts/login.js"></script>
</body>
</html>