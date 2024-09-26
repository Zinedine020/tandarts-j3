<header>
        <nav>
            <div class="container">
            
            <div class="logo-container">
                <img src="assets/images/logo.png" alt="Logo">
            </div>
                <ul>
                        
                    <li><a href="index.php">Home</a></li>
                    <li><a href="appointments.php">Afspraken</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li><a href="login.php">Inloggen</a></li>
                        <li><a href="register.php">Registreren</a></li>
                    <?php else: ?>
                        <li><a href="logout.php">Uitloggen</a></li>
                    <?php endif; ?>
                </ul>
            
        </div>
    </nav>
</header>
