<template>
  <div class="modal">
    <div class="modal-content">
      <h2>Crear equipo</h2>


      <label for="numero_serie">Número de Serie:</label>
      <input v-model="nuevoEquipo.numero_serie" type="text" placeholder="Ingrese el número de serie">

      <hr>


      <label for="categoria_id">Categoría:</label>
      <select v-model="nuevoEquipo.categoria_id" @change="cargarModelos">
        <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">
          {{ categoria.id_categoria }} - {{ categoria.nombre_categoria }}
        </option>
      </select>

      <hr>


      <label for="modelo_id">Modelo:</label>
      <select v-model="nuevoEquipo.modelo_id" :disabled="!nuevoEquipo.categoria_id">
        <option v-for="modelo in modelos" :key="modelo.id_modelo" :value="modelo.id_modelo">
          {{ modelo.nombre_modelo }}
        </option>
      </select>

      <div class="modal-buttons">
        <button @click="guardarEquipo">Guardar</button>
        <button @click="$emit('cerrarModal')">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["mostrarModal"],
  data() {
    return {
      nuevoEquipo: {
        numero_serie: "",
        categoria_id: "",
        modelo_id: ""
      },
      categorias: [],
      modelos: []
    };
  },
  mounted() {
    this.cargarCategorias();
  },
  methods: {
    async cargarCategorias() {
      const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/categories/getAllCategories.php");
      this.categorias = response.data;
    },
    async cargarModelos() {
      if (!this.nuevoEquipo.categoria_id) return;
      const response = await axios.get(
        `http://localhost/BDD-MedicalEquipment/controller/models/getModelByCategory.php?categoria_id=${this.nuevoEquipo.categoria_id}`
      );
      this.modelos = response.data;
      this.nuevoEquipo.modelo_id = "";
    },

    async guardarEquipo() {
      // Verificación de campos obligatorios
      const { numero_serie, categoria_id, modelo_id } = this.nuevoEquipo;
      if (!numero_serie || !categoria_id || !modelo_id) {
        alert("Todos los campos son obligatorios.");
        return;
      }

      try {
        // Crear FormData y agregar campos
        let formData = new FormData();
        formData.append("categoria_id", categoria_id);
        formData.append("modelo_id", modelo_id);
        formData.append("numero_serie", numero_serie);

        // Realizar la petición POST
        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/inventary/create_equipment.php",
          formData,
          {
            headers: { //Usamos el formData para enviar el contenido a la petición
              "Content-Type": "multipart/form-data"
            }
          }
        );

        console.log(response.data);
        alert("Equipo agregado correctamente");
        this.$emit("cerrarModal");
      } catch (error) {
        console.error("Error al guardar el equipo:", error);
      }
    }

  }
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
