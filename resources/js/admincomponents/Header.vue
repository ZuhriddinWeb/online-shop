<template>
    <section class="w-full bg-white drop-shadow">
        <main class="flex px-12 py-4  justify-between">            
            <div class="flex justify-between text-2xl items-center">    
                <button
                    class="menu-toggle duration-500 text-white material-icons text-2xl flex items-center justify-end"
                    @click="emit('open')"
                    :class="{ 'justify-end relative': $store.state.opened }"
                >
                    <i class="fal fa-bars text-orange-600"></i>
                </button>
            </div>
            <div class="flex justify-end text-3xl ">
                <i class="fas fa-user-circle"></i>
            </div>
        </main>
    </section>
    <!-- Header end -->

</template>
  
<script setup>
const emit = defineEmits(['open'])
</script>