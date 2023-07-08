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
                <div class="flex justify-center items-center text-2xl">
                    <p><span><i class="fal fa-file-certificate text-orange-500 mr-4"></i></span>Yangi Kategoriya qo'shish</p>
                </div>
                <form class="w-full  mb-8 mt-8" @submit.prevent="onSubmit" enctype="multipart/form-data">
                    <p>Kategoriya nomi:</p>
                    <input v-model="result.category_name" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-gray-300 py-2 focus:outline-none" type="text" />                        
                    <UploadImage :formData="result"/>
                    <div class="flex justify-between">
                        <button type="submit" class="bg-gray-100 w-1/2 py-1 px-4 mr-2 border-b-2 border-blue-500 hover:bg-blue-200">
                            <i class="far fa-layer-plus mx-2"></i>Saqlash
                        </button>
                        <button @click="emit('close')" class="bg-gray-100 w-1/2 py-1 px-4 ml-2 border-b-2 border-rose-500 hover:bg-rose-200">
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
import UploadImage from "./UploadImage";

const emit = defineEmits(['close'])

const result = reactive({
    category_name:"",
    images: []

});
// const onSubmit = async () => {    
//     const { data } = await axios.post("category-save", result);
//     if (data.status == 200) {
//         emit("added");
//         emit("close");
//     }
// };
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

    const { data } = await axios.post("category-save", formdata);
    if (data.status == 200) {
        emit("added");
        emit("close");
    }
};
</script>