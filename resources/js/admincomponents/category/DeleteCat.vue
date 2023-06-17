<template>
    <main
        @click="$emit('close')"
        class="fixed top-0 left-0 z-40 w-full h-full bg-black bg-opacity-40 flex justify-center items-center p-20"
    >
    <section @click.stop class="bg-white shadow h-1/5 w-1/5">
            <div class="text-right flex flex-col h-full p-4 relative">
                <main class="flex flex-col justify-between w-full items-center mt-8">
                    <button @click="$emit('close')" class="px-3 py-1 hover:text-red-600 absolute right-0 top-0">
                        <i class="fal fa-times"></i>
                    </button>
                    <header class="flex justify-center items-center text-2xl">
                        <!-- {{ $store.state.id_selected }} -->
                        O'chirishga ishonchingiz komilmi?
                    </header>
                    <form class="w-full max-w-sm mb-8 mt-8" @submit.prevent="onSubmit">
                        <div class="flex justify-center">                           
                             <button class="flex items-center w-[100px] justify-center flex-shrink-0 bg-blue-500 hover:bg-blue-600 border-blue-500 hover: text-white py-1 px-2 mr-2" type="submit">
                                <!-- <i class='fal fa-trash-alt text-xl'></i> -->
                               Ha
                            </button>
                            <button @click="$emit('close')" class="flex items-center w-[100px] justify-center flex-shrink-0 bg-rose-500 hover:bg-rose-600 border-rose-500 hover: text-white py-1 px-2" type="submit">
                               <!-- <i class="fal fa-arrow-from-left text-xl"></i> -->
                              Yo'q
                            </button>
                        </div>
                    </form>
                </main>              
            </div>
        </section>
    </main>
</template>

<script setup>
import { reactive, onMounted, ref } from "vue";
const { selectedDataDelete } = defineProps(["selectedDataDelete"]);

const emit = defineEmits("added");


const result = reactive({    
    id: store.state.id_selected,
});

const onSubmit = async () => {
    const { data } = await axios.post(`category-delete`, result);
    if (data.status == 200) {
        emit("added")
        emit("close")
    }
};

</script>
