<div class="container mt-4">
        <h2>Editar Género</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=genre&action=update" method="POST">
            <input type="hidden" name="id_genre" value="<?php echo htmlspecialchars($this->genre->id_genre); ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?php echo htmlspecialchars($this->genre->name); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php?controller=genre&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>