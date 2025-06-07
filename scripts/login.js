// Validation du formulaire Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer tous les formulaires avec 'needs-validation'
    var forms = document.querySelectorAll('.needs-validation');
    
    // Activer la validation Bootstrap
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    // Bouton pour afficher/masquer le mot de passe
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordInput = this.parentElement.querySelector('input');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
});