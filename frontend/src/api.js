// src/services/api.js
import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api', // Cambia esto si es diferente
  headers: {
    'Content-Type': 'application/json',
  },
});

export default {
  // Métodos para interactuar con la API
  getFiles() {
    return apiClient.get('/hello');
  },
  getFile(filename) {
    return apiClient.get(`/hello/${filename}`);
  },
  createFile(fileData) {
    return apiClient.post('/hello', fileData);
  },
  updateFile(filename, fileData) {
    return apiClient.put(`/hello/${filename}`, fileData);
  },
  deleteFile(filename) {
    return apiClient.delete(`/hello/${filename}`);
  },
};
