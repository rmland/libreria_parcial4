<div class="container mt-4">
        <h2>Crear Nuevo Género</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=genre&action=store" method="POST">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=genre&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>