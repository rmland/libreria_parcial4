<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <h2>Géneros</h2>
        </div>
        <div class="col text-end">
            <a href="index.php?controller=genre&action=create" class="btn btn-primary">Nuevo Género</a>
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['ID_GENRE']); ?></td>
                            <td><?php echo htmlspecialchars($row['NAME']); ?></td>
                            <td>
                                <a href="index.php?controller=genre&action=edit&id=<?php echo $row['ID_GENRE']; ?>"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="index.php?controller=genre&action=delete&id=<?php echo $row['ID_GENRE']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este género?')">
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