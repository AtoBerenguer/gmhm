<template>
    <div class="modal">
     
        <div class="modal-buttons">
          <button @click="guardarEquipo">Guardar</button>
          <button @click="$emit('cerrarModalTask')">Cancelar</button>
        </div>
      
    </div>
  </template>
  
  <script>
  
  export default {
    props: ["mostrarModal"],
    data() {
      return {
       
      };
    },
    mounted() {
    },
    methods: {},
      
  };
  </script>
  
  <style scoped>
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-content {
    background: #34495e;
    padding: 20px;
    border-radius: 10px;
    width: 500px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ecf0f1;
  }
  
  h2 {
    font-size: 1.8rem;
    color: #1abc9c;
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    color: #ecf0f1;
    font-size: 1rem;
  }
  
  input,
  select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: none;
    background: #2c3e50;
    color: #ecf0f1;
    font-size: 1rem;
    box-sizing: border-box;
  }
  
  input:focus,
  select:focus {
    outline: none;
    border: 2px solid #1abc9c;
  }
  
  .modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
  }
  
  button {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
  }
  
  button:first-child {
    background-color: #1abc9c;
    color: white;
  }
  
  button:first-child:hover {
    background-color: #16a085;
  }
  
  button:last-child {
    background-color: #e74c3c;
    color: white;
  }
  
  button:last-child:hover {
    background-color: #c0392b;
  }
  </style>
  