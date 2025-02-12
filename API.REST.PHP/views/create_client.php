<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .back{
            background-color:rgb(183, 0, 0);
            transition: .4s
        }
        .back:hover{
            background-color:rgb(118, 8, 8)
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Registro de Cliente</h2>
        <form action="create_client.php" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="city" placeholder="Ciudad" required>
            <input type="tel" name="telephone" placeholder="Teléfono" required>
            <button type="submit" >Registrar</button>
            <button class="back"  onclick="window.location.href='../views/index.php'"> Volver </button>
        </form>
    </div>
    
    

</body>
</html>
