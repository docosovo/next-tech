<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0F0F1A, #1A1A2E);
            color: #F5F5F7;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: linear-gradient(135deg, rgba(26, 26, 46, 0.9), rgba(15, 15, 26, 0.95));
            border-radius: 12px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(0, 212, 255, 0.1);
            overflow: hidden;
            border: 1px solid rgba(0, 212, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: linear-gradient(90deg, #00D4FF, #6C4EF8);
            color: #0F0F1A;
            padding: 25px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #F5F5F7;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        .readonly-field {
            width: 100%;
            padding: 12px 15px;
            background: rgba(15, 15, 26, 0.7);
            border: 1px solid rgba(0, 212, 255, 0.3);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            color: #F5F5F7;
        }

        .readonly-field {
            background-color: rgba(15, 15, 26, 0.5);
            color: #94a3b8;
            cursor: not-allowed;
        }

        input:focus {
            border-color: #00D4FF;
            outline: none;
            box-shadow:
                0 0 0 3px rgba(0, 212, 255, 0.1),
                0 0 15px rgba(0, 212, 255, 0.2);
            background: rgba(15, 15, 26, 0.9);
        }

        input::placeholder {
            color: rgba(245, 245, 247, 0.5);
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #00D4FF, #6C4EF8);
            color: #0F0F1A;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow:
                0 5px 20px rgba(0, 212, 255, 0.4),
                0 0 30px rgba(108, 78, 248, 0.3);
            background: linear-gradient(90deg, #6C4EF8, #00D4FF);
        }

        .btn-secondary {
            background: rgba(255, 107, 107, 0.1);
            color: #FF6B6B;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .btn-secondary:hover {
            background: #FF6B6B;
            color: #0F0F1A;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 107, 107, 0.3);
        }

        .required {
            color: #FF6B6B;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            display: none;
        }

        .success {
            background-color: rgba(0, 255, 157, 0.1);
            color: #00FF9D;
            border: 1px solid rgba(0, 255, 157, 0.3);
        }

        .error {
            background-color: rgba(255, 107, 107, 0.1);
            color: #FF6B6B;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .debug-info {
            background-color: rgba(15, 15, 26, 0.7);
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
            font-family: monospace;
            font-size: 14px;
            color: #94a3b8;
        }

        small {
            color: rgba(245, 245, 247, 0.7);
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 10px;
            }

            .card-body {
                padding: 20px;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
    <?php
    include_once("../config/conexion.php");

    // Habilitar reporte de errores para depuración
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : die('ID de usuario no especificado'));

    // Obtener datos del usuario
    $sql = "SELECT * FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($result);

    if (!$usuario) {
        die('Usuario no encontrado');
    }

    // Función segura para mostrar valores que pueden ser NULL
    function safe_html($value)
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    // Procesar POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<!-- PROCESANDO FORMULARIO -->";

        // Recoger datos y validar que no estén vacíos
        $id = $_POST['id'] ?? '';
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $fnacimiento = $_POST['fnacimiento'] ?? '';
        $contraseña = $_POST['contraseña'] ?? '';

        // Validar campos requeridos
        if (empty($nombre) || empty($apellido) || empty($fnacimiento) || empty($contraseña)) {
            echo "<script>alert('Todos los campos son requeridos');</script>";
        } else {
            // Preparar consulta UPDATE
            $sql = "UPDATE usuario SET 
            nombre = ?, 
            apellido = ?, 
            fnacimiento = ?, 
            contraseña = ? 
            WHERE id = ?";

            $stmt = mysqli_prepare($conexion, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $fnacimiento, $contraseña, $id);

                if (mysqli_stmt_execute($stmt)) {
                    $affected_rows = mysqli_stmt_affected_rows($stmt);

                    if ($affected_rows > 0) {
                        echo "<script>
                        window.location.href = '../html/editaryeliminardato.php';
                    </script>";
                    } else {
                        echo "<script>alert('No se realizaron cambios');</script>";
                    }
                } else {
                    $error = mysqli_error($conexion);
                    echo "<script>alert('Error en la consulta: $error');</script>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Error preparando la consulta');</script>";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuario</title>
        <style>
            .debug-panel {
                background: #f5f5f5;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input[type="text"],
            input[type="date"],
            input[type="password"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .btn-group {
                margin-top: 20px;
            }

            .btn {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 10px;
            }

            .btn-primary {
                background-color: #007bff;
                color: white;
            }

            .btn-secondary {
                background-color: #6c757d;
                color: white;
            }
        </style>
    </head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Editar Datos de Usuario</h1>
                <p>Actualiza la información del usuario</p>
            </div>

            <div class="card-body">

                <form id="editUserForm" method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo safe_html($usuario['id']); ?>">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo safe_html($usuario['nombre']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo safe_html($usuario['apellido']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fnacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fnacimiento" name="fnacimiento" value="<?php echo htmlspecialchars($usuario['fnacimiento'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" id="contraseña" name="contraseña" value="<?php echo safe_html($usuario['contraseña']); ?>" required>
                        <small>Nota: Si no deseas cambiar la contraseña, déjala como está</small>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validación adicional del formulario
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const fnacimiento = document.getElementById('fnacimiento').value;
            const contraseña = document.getElementById('contraseña').value;

            if (!nombre || !apellido || !fnacimiento || !contraseña) {
                alert('Por favor, complete todos los campos requeridos');
                e.preventDefault();
                return false;
            }

            return true;
        });
    </script>
</body>

</html>