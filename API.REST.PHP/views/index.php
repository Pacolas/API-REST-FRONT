<!-- Por temas de tiempo, maneje esto en un solo archivo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>

        body {
            display:grid;
            grid-template-columns: 1fr 4fr;
            font-family: Arial, sans-serif;
            background-color:rgb(43, 46, 45);
            height:80vh;
            padding:4%;
            gap: 1%
            
           
        }
        .header{
        display:flex;
            flex-direction: column;
           background-color : white;
           border-radius: 15px;
           padding:5%;
           gap:4%;
           height:100%; 
            justify-content:center;
            text-align:center
           
     

        }
        .container {
            background: white;
            padding: 2%;
            padding-top: 2%;
            border-radius: 10px;
            height: 100%;
        
            
            overflow:scroll;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 0px;
            margin-top: 20px;
       
        }
        th, td {
          
            border: 1px ;
            padding: 1px;
            text-align: left;

        }
        th {
            background-color:rgb(44, 121, 97);
            color: white;
        }
        tr:hover{
            background-color:  rgb(100, 109, 117);
        }
        button{
            border:0px;
            font-size:100%;
            height: 10%;
            border-radius: 5px


        }
        .delete{
            color:white;
            background-color: rgb(121, 44, 51);
            transition: .3s

        }
        .delete:hover{
            background-color: rgb(185, 61, 71)
        }
        .edit{
            color:white;
            background-color: rgb(229, 229, 207);
            transition: .3s;
            color:black
            

        }
        .edit:hover{
            background-color: rgb(215, 226, 88)
        }
        .create{
            color:white;
            background-color: green;
            transition: .3s;
            height: 5%
        }
        .create:hover{
            background-color: lightgreen
        }
        .bottoms{
            display:flex;
            gap:1px;
            flex-direction:column;
            justify-content: center;
            height:100%
        }
        .options{
            display:flex;
            flex-direction: column
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Lista de Clientes</h2>
        <button class="create" onclick="window.location.href='../api-rest/create_client.php'">
            Crear cliente nuevo
        </button>
       
    </div >
    <div class="container">
        

        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Teléfono</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="clientsTable">
                <tr>
                    <td colspan="4" style="text-align: center;">Cargando clientes...</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <dialog id="modal">
        <form id="editForm">
            <h3>Editar Cliente</h3>
            <input type="hidden" id="clientId">
            <label>Email:</label>
            <input type="email" id="clientEmail" required>
            <label>Nombre:</label>
            <input type="text" id="clientName" required>
            <label>Ciudad:</label>
            <input type="text" id="clientCity" required>
            <label>Teléfono:</label>
            <input type="text" id="clientTelephone" required>
            <button type="submit">Guardar</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </dialog>

    <script>
        function fetchClients() {
            fetch('../api-rest/get_all_client.php') 
                .then(response => response.json())
                .then(data => {
                    let table = document.getElementById('clientsTable');
                    table.innerHTML = "";

                    if (data.length === 0) {
                        table.innerHTML = `<tr><td colspan="5" style="text-align: center;">no hay clientes registrados.</td></tr>`;
                    } else {
                        data.forEach(client => {
                            let row = `<tr>
                                <td>${client.email}</td>
                                <td>${client.name}</td>
                                <td>${client.city}</td>
                                <td>${client.telephone}</td>
                                <td class="options"> 
                                    <button class="edit" onclick="openModal(${client.id}, '${client.email}', '${client.name}', '${client.city}', '${client.telephone}')">
                                        Edit
                                    </button>
                                    <button class="delete" onclick="deleteClient(${client.id})">X</button> 
                                </td>
                            </tr>`;
                            table.innerHTML += row;
                        });
                    }
                })
                .catch(error => {
                    console.error("Error al cargar clientes:", error);
                    
                });
        }

        function deleteClient(id) {
            fetch('../api-rest/delete_client.php?id=${id}', { method: 'DELETE' })
                .then(response => response.text())
                .then(() => fetchClients())
                .catch(error => console.error("Error al eliminar cliente:", error));
        }

        function openModal(id, email, name, city, telephone) {
            document.getElementById('clientId').value = id;
            document.getElementById('clientEmail').value = email;
            document.getElementById('clientName').value = name;
            document.getElementById('clientCity').value = city;
            document.getElementById('clientTelephone').value = telephone;
            document.getElementById('modal').showModal();
        }

        function closeModal() {
            document.getElementById('modal').close();
        }

        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let id = document.getElementById('clientId').value;
            let email = document.getElementById('clientEmail').value;
            let name = document.getElementById('clientName').value;
            let city = document.getElementById('clientCity').value;
            let telephone = document.getElementById('clientTelephone').value;
            console.log(id + email + name + city + telephone)
            
            fetch(`../api-rest/update_client.php?id=${id}&email=${email}&name=${name}&city=${city}&telephone=${telephone}`, {
                method: 'PUT'
            })
            .then(response => response.text())
            .then(() => {
                fetchClients();
                closeModal();
            })
            .catch(error => console.error("Error al actualizar cliente:", error));
        });
        
        fetchClients();
    </script>

</body>
</html>

