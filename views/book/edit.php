<div class="container mt-4">
    <h2>Editar Libro</h2>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=book&action=update" method="POST">
        <input type="hidden" name="id_book" value="<?php echo htmlspecialchars($this->book->id_book); ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Título:</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?php echo htmlspecialchars($this->book->title); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($this->book->description); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="year_publication" class="form-label">Año de Publicación:</label>
            <input type="number" class="form-control" id="year_publication" name="year_publication" 
                   value="<?php echo htmlspecialchars($this->book->year_publication); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_author" class="form-label">Autor:</label>
            <select class="form-control" id="id_author" name="id_author" required>
                <?php foreach ($authors as $author): ?>
                    <option value="<?php echo $author['ID_AUTHOR']; ?>"
                        <?php echo ($author['ID_AUTHOR'] == $this->book->id_author) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($author['FULL_NAME']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_genre" class="form-label">Género:</label>
            <select class="form-control" id="id_genre" name="id_genre" required>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['ID_GENRE']; ?>"
                        <?php echo ($genre['ID_GENRE'] == $this->book->id_genre) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($genre['NAME']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=book&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>