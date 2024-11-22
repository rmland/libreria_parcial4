<div class="container mt-4">
        <h2>Crear Nuevo Autor</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=author&action=store" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="full_name" required>
            </div>

            <div class="mb-3">
                <label for="DATE_OF_BIRTH" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="DATE_OF_BIRTH" name="date_of_birth" required>
            </div>

            <div class="mb-3">
                <label for="DATE_OF_DEATH" class="form-label">Fecha de Muerte:</label>
                <input type="date" class="form-control" id="DATE_OF_DEATH" name="date_of_death" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=author&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>