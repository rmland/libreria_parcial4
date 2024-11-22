<div class="container mt-4">
    <h2>Editar Autor</h2>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=author&action=update" method="POST">
        <input type="hidden" name="id_author" value="<?php echo htmlspecialchars($this->author->id_author); ?>">

        <div class="mb-3">
            <label for="full_name" class="form-label">Nombre Completo:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" 
                   value="<?php echo htmlspecialchars($this->author->full_name); ?>" required>
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                   value="<?php echo htmlspecialchars($this->author->date_of_birth); ?>">
        </div>

        <div class="mb-3">
            <label for="date_of_death" class="form-label">Fecha de Fallecimiento:</label>
            <input type="date" class="form-control" id="date_of_death" name="date_of_death" 
                   value="<?php echo htmlspecialchars($this->author->date_of_death); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=author&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
