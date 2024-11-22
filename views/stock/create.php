<div class="container mt-4">
    <h2>Crear Nuevo Registro de Stock</h2>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=stock&action=store" method="POST">
        <div class="mb-3">
            <label for="id_book" class="form-label">Libro:</label>
            <select class="form-control" id="id_book" name="id_book" required>
                <option value="">Seleccionar Libro</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['ID_BOOK']; ?>">
                        <?php echo htmlspecialchars($book['TITLE']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="total_stock" class="form-label">Stock Total:</label>
            <input type="number" class="form-control" id="total_stock" name="total_stock" required min="0">
        </div>

        <div class="mb-3">
            <label for="last_inventory" class="form-label">Fecha de Último Inventario:</label>
            <input type="date" class="form-control" id="last_inventory" name="last_inventory" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notas:</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?controller=stock&action=index" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>