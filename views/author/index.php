<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <h2>Autores</h2>
        </div>
        <div class="col text-end">
            <a href="index.php?controller=author&action=create" class="btn btn-primary">Nuevo Autor</a>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php
            echo htmlspecialchars($_SESSION['success']);
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Fecha de Muerte</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['ID_AUTHOR']); ?></td>
                            <td><?php echo htmlspecialchars($row['FULL_NAME']); ?></td>
                            <td><?php echo htmlspecialchars($row['DATE_OF_BIRTH']); ?></td>
                            <td><?php echo htmlspecialchars($row['DATE_OF_DEATH']); ?></td>
                            <td>
                                <a href="index.php?controller=author&action=edit&id=<?php echo $row['ID_AUTHOR']; ?>"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="index.php?controller=author&action=delete&id=<?php echo $row['ID_AUTHOR']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este autor?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>