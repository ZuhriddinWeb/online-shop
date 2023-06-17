<template>
    <section @click="emit('close')" class="flex justify-end fixed top-0 left-0 w-full h-full bg-black bg-opacity-30 z-40">
        <aside @click.stop  class="w-2/5 justify-between  overflow-y-auto  p-4  bg-gray-50 shadow">
            <div class="menu flex flex-col justify-between">                  
                <div class="text-black flex justify-between pb-4 pr-4">
                    <span></span>
                    <button @click="emit('close')">
                        <i  class="fal fa-times cursor-pointer text-2xl hover:text-red-600 pr-0"></i>
                    </button>
                </div> 
                <div class="flex justify-center items-center text-3xl">
                    <p>Mahsulot ma'lumotlarini tahrirlash</p>
                </div>
                <form class="w-full  mb-8 mt-8" @submit.prevent="onSubmit" enctype="multipart/form-data">                   
                    <p>Mahsulot nomi:</p>
                    <input v-model="result.product_name" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" />     
                    <p>Mahsulot narxi:</p>
                    <input v-model="result.product_price" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" />
                    <p>Mahsulot hajmi:</p>
                    <input v-model="result.product_sales_price" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" />
                    <p>Mahsulot soni:</p>
                    <input v-model="result.product_count" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" />
                    <p>Mahsulot haqida ma'lumot:</p>
                    <textarea v-model="result.product_descr" name="" id="" cols="30" rows="5" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none"></textarea>
                    <p>Mahsulot instruksiyasi:</p>
                    <textarea v-model="result.product_instr" name="" id="" cols="30" rows="5" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none"></textarea>
                    <!-- <UploadImage :formData="result"/> -->
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 w-1/2 py-1 px-4 mr-2 text-white hover:bg-blue-600">
                            <i class="far fa-layer-plus mx-2"></i>Saqlash
                        </button>
                        <button @click="emit('close')" class="bg-rose-500 w-1/2 py-1 px-4 ml-2 text-white hover:bg-rose-600">
                            <i class="far fa-times mx-2"></i>Bekor qilish
                        </button>
                    </div>
                </form>
            </div>          
        </aside>
    </section>
</template>
  
<script setup>
import { reactive, onMounted, ref } from "vue";
import store from "../../store";
import UploadImage from "./UploadImage";
const emit = defineEmits(['close'])

const result = reactive({
    category_id:store.state.id_selected,
    product_id:store.state.id_select,
    product_name:"",
    product_price:"",
    volume:"",
    product_count:"",
    product_descr:"",
    product_instr:"",
    // images: []
});
axios.get(`products-by-id/${store.state.id_select}`).then((res) => {
         result.product_name = res.data[0].product_name
         result.product_price = res.data[0].price    
         result.volume = res.data[0].volume    
         result.product_count = res.data[0].count_products    
         result.product_descr = res.data[0].description_product    
         result.product_instr = res.data[0].instruction_product    
})
const onSubmit = async () => {
    const formdata = new FormData()
    for (const key in result) {
        if(key == 'images'){
            result.images.forEach(image => {
                formdata.append('images[]', image)
            })
        }
        else formdata.append(key, result[key])
    }
    
    const { data } = await axios.post("product-update", result);
    if (data.status == 200) {
        emit("added");
        emit("close");
    }
};
</script>