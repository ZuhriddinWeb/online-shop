<template>
    <section class="flex flex-col justify-between h-screen">
        <AddStat
            @added="gridRestart"
            @close="status_input = null"
            :selectedDataInput="status_input"
            v-if="status_input"
        />
        <DeleteStat
            @added="gridRestart"
            @close="status_delete = null"
            :selectedDataEdit="status_delete"
            v-if="status_delete"
        />
        <UpdateStat
            @added="gridRestart"
            @close="status_update = null"
            :selectedDataEdit="status_update"
            v-if="status_update"
        />
        <div class="flex justify-between mb-4">
            <div></div>
            <div>
                <button class="bg-orange-500 py-1 px-4 text-white hover:bg-orange-600"  @click="status_input = true">
                    <i class="far fa-layer-plus mx-2"></i>Yangi qo'shish
                </button>
            </div>
        </div>
        <ag-grid-vue
                class="ag-theme-material h-full w-full shadow border-0"
                :columnDefs="columnDefs"
                :rowData="rowData"
                :defaultColDef="defaultColDef"
                animateRows="true"
                :rowSelection="'multiple'"
                @rowDoubleClicked="rowProtocolSelect">
        </ag-grid-vue>
    </section>
</template>
  
<script setup>
import axios from "axios";
import { reactive, onMounted, ref, inject } from "vue";
import store from "../store";
import AddStat from '../admincomponents/status/AddStat.vue'
import DeleteStat from '../admincomponents/status/DeleteStat.vue'
import UpdateStat from '../admincomponents/status/UpdateStat.vue'

const status_input = ref(null);
const status_update = ref(null);
const status_delete = ref(null);

const gridApi = ref(null); // Optional - for accessing Grid's API
const onGridReady = (params) => {
    gridApi.value = params.api;
};
const rowData = ref(null); // Set rowData to Array of Objects, one Object per Row
const columnDefs = reactive([
        { headerName: "T/r", valueGetter: "node.rowIndex + 1", width: 120 },
        { headerName: "Kod", field: "id",width: 120 },
        { headerName: "Unique ID", field: "status_id",width: 500 },
        { headerName: "Nomi", field: "status_name",flex:1 },
        {
            headerName: "",
            field: "",
            width: 70,
            onCellClicked: function (select) {
                return getEdit(select.data);
            },
            cellRenderer: (params) =>
                "<div><button @click='status_update=true'><i class='fal fa-edit  text-xl hover:text-green-400'></i></button></div>",
        },
        {
            headerName: "",
            field: "",
            width: 70,
            onCellClicked: function (select) {
                return getDelete(select.data);
            },
            cellRenderer: (params) =>
                "<div><button @click='status_delete=true'><i class='fal fa-trash-alt text-xl hover:text-red-400'></i></button></div>",
        },
      ],
     );

const defaultColDef = {
    sortable: true,
    filter: true,
};
async function getEdit(e) {
    if (e.id != "") {
        // console.log(e);
        store.state.id_selected = e.status_id;
        status_update.value = true;
    }
}

async function getDelete(e) {
    // console.log(e);
    if (e.id != "") {
        store.state.id_selected = e.status_id;
        status_delete.value = true;
    }
}
function gridRestart() {
    getRowData();
}
async function getRowData() {
    const { data } = await axios.get(`status`);
    rowData.value = data;
}

onMounted(async () => {   
    getRowData();
});
</script>