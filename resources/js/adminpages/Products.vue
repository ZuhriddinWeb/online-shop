
<template>
    <section class="flex flex-col justify-between h-screen">
        <AddProducts
            @added="gridRestart"
            @close="products_input = null"
            :selectedDataInput="products_input"
            v-if="products_input"
        />
        <DeleteProducts
            @added="gridRestart"
            @close="products_delete = null"
            :selectedDataEdit="products_delete"
            v-if="products_delete"
        />
        <UpdateProducts
            @added="gridRestart"
            @close="products_update = null"
            :selectedDataEdit="products_update"
            v-if="products_update"
        />
        <div class="flex justify-between mb-4">
            <div></div>
            <div>                
                <button class="bg-gray-100 border-b border-orange-500  py-1 px-4  hover:bg-orange-200" v-if="$store.state.id_selected" @click="products_input=true">
                    <i class="far fa-layer-plus mx-2"></i>Yangi qo'shish
                </button>
                <button class="bg-gray-100 border-b border-orange-500  py-1 px-4  hover:bg-orange-200" v-else="products_input=true">
                    <i class="far fa-layer-plus mx-2"></i>Yangi qo'shish
                </button>
            </div>
        </div>
        <div class="flex justify-between h-full">
            <div class="bg-white w-1/5 mr-2 shadow">
                <h3 class="flex justify-center items-center h-14 text-xl border-b-2 border-gary-200">Kategoriyalar</h3>          
                    <div v-for="item,index in rowData" :class="{'bg-gray-100-200': store.state.id_selected == item.id}" @click="select_product_id(item.id)">
                        <p  class="flex justify-start items-center center  border-b-2 border-gray-200 cursor-pointer hover:bg-gray-100">
                            <div class="mr-2 bg-gray-100 h-full w-[65px] py-[11px] text-center px-3">{{index+1}}</div>
                            <span>{{ item.name }}</span>
                        </p>
                    </div>
            </div>
            
        <div class="bg-white w-4/5 ml-2">
            <ag-grid-vue
                class="ag-theme-material h-full w-full shadow border-0"
                :columnDefs="columnDefs"
                :rowData="product_info"
                :defaultColDef="defaultColDef"
                animateRows="true"
                :rowSelection="'multiple'"
                @grid-ready="onGridReady"
                >
        </ag-grid-vue>
        </div>
        </div>
    </section>
</template>

<script setup>
import axios from "axios";
import { reactive, onMounted, ref, inject } from "vue";
import store from "../store";
import AddProducts from '../admincomponents/products/AddProducts.vue'
import DeleteProducts from '../admincomponents/products/DeleteProducts.vue'
import UpdateProducts from '../admincomponents/products/UpdateProducts.vue'
const emit = defineEmits(['close'])

const products_input = ref(null);
const products_update = ref(null);
const products_delete = ref(null);

const gridApi = ref(null); // Optional - for accessing Grid's API
const onGridReady = (params) => {
    gridApi.value = params.api;
};
const product_info=ref(null);
const rowData = ref(null); // Set rowData to Array of Objects, one Object per Row

async function select_product_id(id){
    store.state.id_selected = id
    const { data } = await axios.get(`products/${id}`)
    product_info.value = data;
}

const columnDefs = reactive([
        { headerName: "T/r", valueGetter: "node.rowIndex + 1", width: 100 },
        { headerName: "Unique ID", field: "product_id",width: 90 },
        { headerName: "Unique Cat", field: "category_id",width: 90 },
        { headerName: "Kategoriya", field: "category_name",flex:1 },
        { headerName: "Mahsulot", field: "product_name",flex:1 },
        { headerName: "Narxi", field: "price",flex:1 },
        { headerName: "Hajmi", field: "volume",flex:1 },
        { headerName: "Soni", field: "count_products",flex:1 },
       
        {
            headerName: "",
            field: "",
            width: 70,
            onCellClicked: function (select) {
                return getEdit(select.data);
            },
            cellRenderer: (params) =>
                "<div><button @click='products_update=true'><i class='fal fa-edit  text-xl hover:text-green-400'></i></button></div>",
        },
        {
            headerName: "",
            field: "",
            width: 70,
            onCellClicked: function (select) {
                return getDelete(select.data);
            },
            cellRenderer: (params) =>
                "<div><button @click='products_delete=true'><i class='fal fa-trash-alt text-xl hover:text-red-400'></i></button></div>",
        },
      ],
     );

const defaultColDef = {
    sortable: true,
    filter: true,
};
async function getEdit(e) {
    if (e.id != "") {
        store.state.id_select = e.product_id;
        store.state.id_selected = e.category_id;
        products_update.value = true;
    }
}

async function getDelete(e) {
    if (e.id != "") {
        store.state.id_select = e.product_id;
        store.state.id_selected = e.category_id
        products_delete.value = true;
    }
}
function gridRestart() {
    select_product_id(store.state.id_selected)
    getRowData();
}
async function getRowData() {
    // const { data } = await axios.get(`category`);
    // rowData.value = data;
    const { data } = await axios.get(`tree`);
    rowData.value = data;
    // axios.get(`tree`).then((res) => {
    //   tree_result.value = res.data;
    // })
}

onMounted(async () => {   
    getRowData();
});
</script>

<style setup>

</style>