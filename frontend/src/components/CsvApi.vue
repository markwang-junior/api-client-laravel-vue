<template>
    <div class="csv-rest-client">
      <h1>API CSV Client</h1>
  
      <!-- Campo de entrada para el nombre del archivo -->
      <input
        id="userInput"
        type="text"
        v-model="userInput"
        placeholder="Escribe el nombre del archivo CSV"
      />
      
      <!-- Campo de entrada para el contenido del archivo (solo para POST y PUT) -->
      <textarea
        id="contentInput"
        v-model="contentInput"
        placeholder="Introduce el contenido del archivo CSV"
      ></textarea>
  
      <!-- Botones para ejecutar las acciones en la API CSV -->
      <div class="csv-actions">
        <h3>Acciones en la API CSV</h3>
        <button @click="handleCsvGet">OBTENER CSV</button>
        <button @click="handleCsvPost">CREAR CSV</button>
        <button @click="handleCsvPut">ACTUALIZAR CSV</button>
        <button @click="handleCsvDelete">ELIMINAR CSV</button>
        <button @click="handleCsvList">LISTAR CSV</button>
      </div>
  
      <!-- Sección que muestra la respuesta de la API -->
      <div v-if="apiResponse">
        <h3>Respuesta de la API:</h3>
        <pre>{{ apiResponse }}</pre>
      </div>
  
      <!-- Sección que muestra un mensaje de error si algo falla -->
      <div v-if="errorMessage" class="error">
        <h3>Error:</h3>
        <pre>{{ errorMessage }}</pre>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CsvApi',
    data() {
      return {
        userInput: '', // Almacena el nombre del archivo ingresado
        contentInput: '', // Almacena el contenido del archivo ingresado
        apiResponse: null, // Respuesta de la API
        errorMessage: null, // Mensaje de error
      };
    },
    methods: {
        async handleCsvGet() {
        if (!this.userInput.trim()) {
            this.errorMessage = 'Por favor, introduce el nombre del archivo.';
            return;
        }

        try {
            const response = await axios.get(`http://localhost:8000/api/csv/${this.userInput}`);
            if (response.data.contenido && response.data.contenido.length > 0) {
            // Procesa el contenido del CSV
            this.apiResponse = response.data;
            this.errorMessage = null;

            // Convierte el array de objetos a texto CSV
            const header = Object.keys(response.data.contenido[0]).join(',');
            const rows = response.data.contenido.map(row => Object.values(row).join(',')).join('\n');
            this.contentInput = `${header}\n${rows}`;
            } else {
            // Si el contenido está vacío
            this.apiResponse = response.data;
            this.contentInput = ''; // Limpia el campo de contenido
            this.errorMessage = 'El archivo está vacío o no tiene contenido legible.';
            }
        } catch (error) {
            this.handleApiError(error);
        }
        },

  
      async handleCsvPost() {
        if (!this.userInput.trim() || !this.contentInput.trim()) {
          this.errorMessage = 'Por favor, introduce el nombre del archivo y su contenido.';
          return;
        }
  
        try {
          const response = await axios.post('http://localhost:8000/api/csv', {
            filename: this.userInput,
            content: this.contentInput,
          });
          this.apiResponse = response.data;
          this.errorMessage = null;
        } catch (error) {
          this.handleApiError(error);
        }
      },
  
      async handleCsvPut() {
    if (!this.userInput.trim() || !this.contentInput.trim()) {
        this.errorMessage = 'Por favor, introduce el nombre del archivo y su contenido.';
        return;
    }

    // Limpia y valida el contenido
    const cleanedContent = this.contentInput.trim();
    if (!cleanedContent) {
        this.errorMessage = 'El contenido del archivo no puede estar vacío.';
        return;
    }

    const rows = cleanedContent.split('\n');
    const headers = rows[0].split(',');

    // Validar que todas las filas tengan el mismo número de columnas que la cabecera
    for (let i = 1; i < rows.length; i++) {
        const columns = rows[i].split(',');
        if (columns.length !== headers.length) {
        this.errorMessage = 'Todas las filas deben tener el mismo número de columnas que la cabecera.';
        return;
        }
    }

    try {
        console.log('Contenido enviado al backend para actualización:', cleanedContent);

        // Enviar solicitud PUT al backend
        const response = await axios.put(`http://localhost:8000/api/csv/${this.userInput}`, {
        content: cleanedContent,
        });

        this.apiResponse = response.data;
        this.errorMessage = null;
    } catch (error) {
        this.handleApiError(error);
    }
},


  
      async handleCsvDelete() {
        if (!this.userInput.trim()) {
          this.errorMessage = 'Por favor, introduce el nombre del archivo.';
          return;
        }
  
        try {
          const response = await axios.delete(`http://localhost:8000/api/csv/${this.userInput}`);
          this.apiResponse = response.data;
          this.errorMessage = null;
        } catch (error) {
          this.handleApiError(error);
        }
      },
  
      async handleCsvList() {
        try {
          const response = await axios.get('http://localhost:8000/api/csv');
          this.apiResponse = response.data;
          this.errorMessage = null;
        } catch (error) {
          this.handleApiError(error);
        }
      },
  
      handleApiError(error) {
        this.apiResponse = null;

        if (error.response) {
            this.errorMessage = error.response.data.mensaje || 'Error en la solicitud.';
        } else {
            this.errorMessage = 'Error al conectar con la API.';
        }
        }

    },
  };
  </script>
  
  <style scoped>
  .csv-rest-client {
    text-align: center;
    max-width: 600px;
    margin: auto;
  }
  textarea,
  input {
    width: calc(100% - 20px);
    margin: 10px 0;
    padding: 10px;
  }
  button {
    margin: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }
  .error {
    color: red;
  }
  h3 {
    margin: 20px 0;
  }
  </style>
  