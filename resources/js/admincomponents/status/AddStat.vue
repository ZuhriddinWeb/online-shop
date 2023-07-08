<template>
     <main        
        class="fixed top-0 left-0 z-40 w-full h-full bg-black bg-opacity-40 flex justify-center items-center p-20"
    >
        <section @click.stop class="bg-white shadow h-[25%] w-3/6">
            <div class="flex flex-col h-full p-4 relative">
                <main class="flex flex-col h-full justify-between w-full items-center ">
                    <button @click="$emit('close')" class="px-3 py-1 text-red-500 hover:text-red-600 absolute right-0 top-0">
                        <i class="fal fa-times"></i>
                    </button>
                    <header class="flex justify-center items-center text-2xl">                       
                        Yangi status yaratish
                    </header>
                    <form class="w-full  mb-8 mt-8" @submit.prevent="onSubmit">                   
                    <p>Status nomi:</p>
                    <input v-model="result.status_name" class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" />
                        <main class="flex justify-end my-6 ">
                            <button class="flex w-[100px] items-center justify-center mt-2 mr-2 bg-blue-500 hover:bg-blue-600 border-blue-500 hover: text-white py-1 px-2" type="submit">                              
                                Saqlash
                            </button>
                            <button  @click="$emit('close')" class="flex w-[100px]  items-center mt-2 bg-rose-500 hover:bg-rose-600 border-rose-500 hover: text-white py-1 px-2" type="submit">                   
                                Bekor qilish
                            </button>
                        </main>                        
                    </form>
                </main>
            </div>
        </section>
    </main>
</template>
  
<script setup>
import { reactive, onMounted, ref } from "vue";
const emit = defineEmits(['close'])

const result = reactive({
    status_name:"",
});
const onSubmit = async () => {    
    const { data } = await axios.post("status-save", result);
    if (data.status == 200) {
        emit("added");
        emit("close");
    }
};
</script>