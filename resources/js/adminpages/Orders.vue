<template>
    <section class="flex flex-col justify-between h-screen">
        <InfoOrder
            @close="openInfo = null"
            :selectedDataEdit="openInfo"
            v-if="openInfo"
        />
       
        <ag-grid-vue
                class="ag-theme-material h-full w-full shadow border-0"
                :columnDefs="columnDefs"
                :rowData="rowData"
                :defaultColDef="defaultColDef"
                animateRows="true"
                :rowSelection="'multiple'"
                @rowDoubleClicked="rowProtocolSelect"
                :getRowClass="getRowClass"
                >
        </ag-grid-vue>
    </section>
</template>
  
<script setup>
import axios from "axios";
import { reactive, onMounted, ref, inject } from "vue";
import store from "../store";
import InfoOrder from '../admincomponents/orders/InfoOrder.vue'

const openInfo = ref(null);
const gridApi = ref(null); // Optional - for accessing Grid's API
const onGridReady = (params) => {
    gridApi.value = params.api;
};
const rowData = ref(null); // Set rowData to Array of Objects, one Object per Row
const columnDefs = reactive([
        { headerName: "T/r", valueGetter: "node.rowIndex + 1", width: 120 },
        { headerName: "Kod", field: "id",width: 120 },
        { headerName: "User Id", field: "user_id",flex:1 },
        { headerName: "Buyurtma vaqti", field: "created_at",flex:1 },
        {
            headerName: "",
            field: "",
            width: 70,
            onCellClicked: function (select) {
                return getEdit(select.data);
            },
            cellRenderer: (params) =>
                "<div><button @click='category_update=true'><i class='fal fa-comment-alt-dollar  text-xl hover:text-green-400'></i></button></div>",
        },
        
      ],
     );
function getRowClass (params) {
    // const day = moment(params.data.next_exam_date)
    // const today = moment()
    // const diff = day.diff(today, 'days')
    if(params.data.order_check==1) return '!bg-green-100'
    else if(params.data.order_check==2) return '!bg-red-100'
    else if(params.data.order_check==3) return '!bg-orange-100'

};
const defaultColDef = {
    sortable: true,
    filter: true,
};
async function getEdit(e) {
    if (e.id != "") {
        store.state.user_id_order=e.user_id
        store.state.id_selected = e.id;
        openInfo.value = true;
    }
}


function gridRestart() {
    getRowData();
}
async function getRowData() {
    const { data } = await axios.get(`orders`);
    rowData.value = data;
}

onMounted(async () => {   
    getRowData();
});
</script>