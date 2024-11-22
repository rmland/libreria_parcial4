<div class="container mt-4">
    <h2>Editar Registro de Stock</h2>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=stock&action=update" method="POST">
        <input type="hidden" name="id_stock" value="<?php echo htmlspecialchars($this->stock->id_stock); ?>">

        <div class="mb-3">
            <label for="id_book" class="form-label">Libro:</label>
            <select class="form-control" id="id_book" name="id_book" required>
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['ID_BOOK']; ?>"
                        <?php echo ($book['ID_BOOK'] == $this->stock->id_book) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($book['TITLE']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="total_stock" class="form-label">Stock Total:</label>
            <input type="number" class="form-control" id="total_stock" name="total_stock" 
                   value="<?php echo htmlspecialchars($this->stock->total_stock); ?>" required min="0">
        </div>

        <div class="mb-3">
            <label for="last_inventory" class="form-label">Fecha de Último Inventario:</label>
            <input type="date" class="form-control" id="last_inventory" name="last_inventory" 
                   value="<?php echo htmlspecialchars($this->stock->last_inventory); ?>" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notas:</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"><?php echo htmlspecialchars($this->stock->notes); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=stock&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>