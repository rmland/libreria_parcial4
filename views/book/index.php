<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col">
                <h2>Libros</h2>
            </div>
            <div class="col text-end">
                <a href="index.php?controller=book&action=create" class="btn btn-primary">
                    Nuevo Libro
                </a>
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
                            <th>Título</th>
                            <th>Año Publicación</th>
                            <th>Autor</th>
                            <th>Género</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['ID_BOOK']); ?></td>
                                <td><?php echo htmlspecialchars($row['TITLE']); ?></td>
                                <td><?php echo htmlspecialchars($row['YEAR_PUBLICATION']); ?></td>
                                <td><?php echo htmlspecialchars($row['FULL_NAME']); ?></td>
                                <td><?php echo htmlspecialchars($row['NAME']); ?></td>
                                <td>
                                    <a href="index.php?controller=book&action=edit&id=<?php echo $row['ID_BOOK']; ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="index.php?controller=book&action=delete&id=<?php echo $row['ID_BOOK']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este libro?')">
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