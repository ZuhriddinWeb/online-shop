<template>
    <main        
        class="fixed top-0 left-0 z-40 w-full h-full bg-black bg-opacity-40 flex justify-center items-center p-20"
    >
        <section @click.stop class="bg-white shadow h-[25%] w-3/6">
            <div class="flex flex-col h-full p-4 relative">
                <main class="flex flex-col justify-between w-full items-center " >
                    <button  @click="$emit('close')"  class="px-3 py-1 hover:text-red-600 absolute right-0 top-0">
                        <i class="fal fa-times"></i>
                    </button>
                    <header class="flex justify-center items-center text-2xl">
                        <!-- {{$store.state.id_selected}} -->
                        Status ma'lumotlarini tahrirlash:
                    </header>
                    <form  class="w-full  mb-8 mt-8" @submit.prevent="onSubmit">                    
                    <p>Status nomi:</p>
                    <input class="mb-2 appearance-none bg-transparent w-full text-gray-700 mr-3 px-2 leading-tight border-b border-orange-400 py-2 focus:outline-none" type="text" v-model="result.status_name"/>
                        <main class="flex justify-end mt-6">
                            <button class="flex w-[100px] items-center justify-center mt-2 mr-2 bg-blue-500 hover:bg-blue-600 border-blue-500 hover: text-white py-1 px-2" type="submit">
                                <!-- <i class="fal fa-plus-square text-xl pr-1"></i> -->
                                Saqlash
                            </button>
                            <button @click="$emit('close')" class="flex w-[100px]  items-center mt-2 bg-rose-500 hover:bg-rose-600 border-rose-500 hover: text-white py-1 px-2" type="submit">
                                <!-- <i class="fal fa-arrow-from-left text-xl"></i> -->
                                Bekor qilish
                            </button>
                        </main>
                        <!-- </div> -->
                    </form>
                </main>
            </div>
        </section>
    </main>
</template>

<script setup>
import { reactive, onMounted, ref } from "vue";
const emit = defineEmits("added");

const result = reactive({
    status_name:"",
    status_id:store.state.id_selected,
});
axios.get(`status-id/${store.state.id_selected}`).then((res) => {
         result.status_name = res.data[0].status_name       
})
const onSubmit = async () => {  
    const { data } = await axios.post(`status-update`, result);
    if (data.status == 200) {
        emit("added");
        emit("close");
    }
};
</script>
