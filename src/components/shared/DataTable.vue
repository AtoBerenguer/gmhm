<template>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th v-for="(header, key) in headers" :key="key">
                        {{ header }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in paginatedData" :key="index" @click="seleccionarObjeto(item)" >
                    <td v-for="(header, key) in headers" :key="key" :title="item[key]">
                        {{ ['averia','fecha']? (item[key]?.slice(0, 25) + (item[key]?.length > 30 ? '...' : '')) : item[key] }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Anterior</button>
            <span>Página {{ currentPage }} de {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Siguiente</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Array,
            required: true,
        },
        headers: {
            type: Object, // key: Nombre del header para el encabezado
            required: true,
        },
        itemsPerPage: {
            type: Number,
            default: 15, // Número de elementos por página por defecto 15
        },
    },
    data() {
        return {
            currentPage: 1,
        };
    },
    computed: {
        totalPages() { //El numero total de paginas sera el el total de elementos dividos por el numero de elementos por pagina por defecto 15.
            return Math.ceil(this.data.length / this.itemsPerPage);
        },
        paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage; //Le damos el valor de 1 para mostrar la primera pagina de la tabla.
            return this.data.slice(start, start + this.itemsPerPage);
        },
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        seleccionarObjeto(item) { //Cuando pulsamos usemos esta funcion enviaremos el elemento de la tabla al siguiente componente.
            // console.log(item);
           
            this.$emit("objetoSeleccionado", item);
            
            
        },
    },
};
</script>

<style scoped>
.table-container {
    width: 100%;
    overflow-x: auto;
    text-align: center;

}

table {
    width: 100%;
    color: white;
    table-layout: fixed;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    border: 1px solid #ddd;
}

th {
    background: #16a085;
    color: white;
}

tbody tr:nth-child(even) {
    background-color: #34495e;
}

tbody tr:nth-child(odd) {
    background-color: #2f3c4a;
}

.pagination {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

button {
    margin: 5px;
    padding: 5px 10px;
    background: #16a085;
    color: white;
    border: none;
    cursor: pointer;
}

button:disabled {
    background: gray;
}
td,th{
white-space: nowrap;
overflow: hidden;




}

</style>