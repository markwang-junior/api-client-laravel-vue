<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <input
      id="userInput"
      type="text"
      v-model="userInput" 
      placeholder="Type here"
    />
    <button @click="handleClick">click me</button>

    <!-- Mostrar la respuesta de la API -->
    <div v-if="apiResponse">
      <h3>Response from API:</h3>
      <pre>{{ apiResponse }}</pre>
    </div>

    <!-- Mostrar mensaje de error si ocurre alguno -->
    <div v-if="errorMessage" style="color: red;">
      <h3>Error:</h3>
      <pre>{{ errorMessage }}</pre>
    </div>
  </div>
</template>



<script>
import axios from 'axios';  // Importa axios para hacer solicitudes HTTP

export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  data() {
    return {
      userInput: '',  // Almacena lo que el usuario introduce
      apiResponse: null,  // Almacena la respuesta de la API
      errorMessage: null  // Almacena un mensaje de error en caso de fallo
    };
  },
  methods: {
    getFile(filename) {
      // Realiza la solicitud GET a la API de Laravel
      axios.get(`http://localhost:8000/api/hello/${filename}`)
        .then(response => {
          // Si la solicitud es exitosa, almacena la respuesta
          this.apiResponse = response.data;
          this.errorMessage = null;  // Limpia el mensaje de error
        })
        .catch(error => {
          // Si hay un error, muestra un mensaje de error
          this.apiResponse = null;  // Limpia la respuesta anterior
          this.errorMessage = error.message || 'An error occurred';
        });
    },
    handleClick() {
      if (this.userInput.trim() !== '') {
        this.getFile(this.userInput);  // Llamar a la API con el input del usuario
      } else {
        this.errorMessage = 'Please enter a valid input';  // Mensaje de error si el input está vacío
      }
    }
  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
