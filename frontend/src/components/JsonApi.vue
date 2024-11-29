<template>
  <div class="api-rest-client">
    <h1>API REST Client</h1>

    <!-- Campo de entrada donde el usuario escribe el nombre del archivo (común para ambas APIs) -->
    <input
      id="userInput"
      type="text"
      v-model="userInput"
      placeholder="Escribe el nombre del archivo"
    />
    
    <!-- Campo de entrada para el contenido del archivo (solo para POST y PUT) -->
    <input
      id="contentInput"
      type="text"
      v-model="contentInput"
      placeholder="Introduce el contenido del archivo"
    />
    
    <!-- Botones para ejecutar las acciones en la API JSON -->
    <div class="json-actions">
      <h3>Acciones en la API JSON</h3>
      <button @click="handleJsonGet">OBTENER JSON</button>
      <button @click="handleJsonPost">CREAR JSON</button>
      <button @click="handleJsonPut">ACTUALIZAR JSON</button>
      <button @click="handleJsonDelete">ELIMINAR JSON</button>
      <button @click="handleJsonList">LISTAR JSON</button>
    </div>

    <!-- Botones para ejecutar las acciones en la API HelloWorld -->
    <div class="hello-actions">
      <h3>Acciones en la API HelloWorld</h3>
      <button @click="handleHelloGet">OBTENER Archivo</button>
      <button @click="handleHelloPost">CREAR Archivo</button>
      <button @click="handleHelloPut">ACTUALIZAR Archivo</button>
      <button @click="handleHelloDelete">ELIMINAR Archivo</button>
      <button @click="handleHelloList">LISTAR Archivos</button>
    </div>

    <!-- Sección que muestra la respuesta de la API -->
    <div v-if="apiResponse">
      <h3>Respuesta de la API:</h3>
      <pre>{{ apiResponse }}</pre>
    </div>

    <!-- Sección que muestra un mensaje de error si algo falla -->
    <div v-if="errorMessage" style="color: red;">
      <h3>Error:</h3>
      <pre>{{ errorMessage }}</pre>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ClienteApi',
  data() {
    return {
      userInput: '',
      contentInput: '',
      apiResponse: null,
      errorMessage: null
    };
  },
  methods: {
    // Métodos de la API JSON
    getJson(id) {
      axios.get(`http://localhost:8000/api/json/${id}`)
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    listJson() {
      axios.get('http://localhost:8000/api/json')
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    postJson(id, content) {
      axios.post('http://localhost:8000/api/json', { filename: id, content })
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    putJson(id, content) {
      axios.put(`http://localhost:8000/api/json/${id}`, { content })
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    deleteJson(id) {
      axios.delete(`http://localhost:8000/api/json/${id}`)
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },

    // Métodos de la API HelloWorld
    getHelloFile(filename) {
      axios.get(`http://localhost:8000/api/hello/${filename}`)
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    listHelloFiles() {
      axios.get('http://localhost:8000/api/hello')
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    postHelloFile(filename, content) {
      axios.post('http://localhost:8000/api/hello', { filename, content })
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    putHelloFile(filename, content) {
      axios.put(`http://localhost:8000/api/hello/${filename}`, { content })
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },
    deleteHelloFile(filename) {
      axios.delete(`http://localhost:8000/api/hello/${filename}`)
        .then(response => {
          this.apiResponse = response.data;
          this.errorMessage = null;
        })
        .catch(error => {
          this.apiResponse = null;
          this.errorMessage = error.response ? error.response.data : error.message || 'Ocurrió un error';
        });
    },

    // Métodos que se llaman al hacer clic en los botones para JSON API
    handleJsonGet() {
      if (this.userInput.trim() !== '') {
        this.getJson(this.userInput);
      } else {
        this.errorMessage = 'Por favor, ingresa un ID válido';
      }
    },
    handleJsonList() {
      this.listJson();
    },
    handleJsonPost() {
      if (this.userInput.trim() !== '' && this.contentInput.trim() !== '') {
        try {
          const contentObject = JSON.parse(this.contentInput);
          this.postJson(this.userInput, contentObject);
        } catch (e) {
          this.errorMessage = 'Formato JSON no válido';
        }
      } else {
        this.errorMessage = 'Por favor, ingresa tanto el ID como el contenido';
      }
    },
    handleJsonPut() {
      if (this.userInput.trim() !== '' && this.contentInput.trim() !== '') {
        try {
          const contentObject = JSON.parse(this.contentInput);
          this.putJson(this.userInput, contentObject);
        } catch (e) {
          this.errorMessage = 'Formato JSON no válido';
        }
      } else {
        this.errorMessage = 'Por favor, ingresa tanto el ID como el contenido';
      }
    },
    handleJsonDelete() {
      if (this.userInput.trim() !== '') {
        this.deleteJson(this.userInput);
      } else {
        this.errorMessage = 'Por favor, ingresa un ID válido';
      }
    },

    // Métodos que se llaman al hacer clic en los botones para HelloWorld API
    handleHelloGet() {
      if (this.userInput.trim() !== '') {
        this.getHelloFile(this.userInput);
      } else {
        this.errorMessage = 'Por favor, ingresa un nombre de archivo válido';
      }
    },
    handleHelloList() {
      this.listHelloFiles();
    },
    handleHelloPost() {
      if (this.userInput.trim() !== '' && this.contentInput.trim() !== '') {
        this.postHelloFile(this.userInput, this.contentInput);
      } else {
        this.errorMessage = 'Por favor, ingresa tanto el nombre del archivo como el contenido';
      }
    },
    handleHelloPut() {
      if (this.userInput.trim() !== '' && this.contentInput.trim() !== '') {
        this.putHelloFile(this.userInput, this.contentInput);
      } else {
        this.errorMessage = 'Por favor, ingresa tanto el nombre del archivo como el contenido';
      }
    },
    handleHelloDelete() {
      if (this.userInput.trim() !== '') {
        this.deleteHelloFile(this.userInput);
      } else {
        this.errorMessage = 'Por favor, ingresa un nombre de archivo válido';
      }
    }
  }
}
</script>

<style scoped>
h3 {
  margin: 20px 0 10px;
}
button {
  margin: 5px;
}
.api-rest-client {
  text-align: center;
}
input {
  margin: 5px;
  padding: 8px;
}
</style>