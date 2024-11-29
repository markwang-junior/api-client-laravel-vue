<template>
  <div class="hello">
    <!-- Título con el mensaje recibido como propiedad -->
    <h1>{{ msg }}</h1>
    
    <!-- Aquí se incluirán los componentes JsonApi y CsvApi -->
    <JsonApi />
    <CsvApi />
  </div>
</template>

<script>
import JsonApi from './JsonApi.vue';
import CsvApi from './CsvApi.vue';

export default {
  name: 'HelloWorld',
  props: {
    msg: String,
  },
  components: {
    JsonApi,
    CsvApi, // Añadimos el nuevo componente aquí
  },
};
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
