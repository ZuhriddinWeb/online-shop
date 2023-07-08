<template>
    <section  class="bg-gray-100 h-screen flex flex-col justify-between overflow-y-scroll">
        <Header @open="sideBarToggle = true" />
        <transition name="fade">
          <SidebarVue v-if="sideBarToggle" @close="sideBarToggle = false" class="no-print"/>
        </transition>
        <router-view class="py-4 px-12 flex-grow no-print" />        
    </section>
  </template>
  
<script setup>  
import { ref } from "vue"
import Header from '../admincomponents/Header.vue';
import SidebarVue from '../admincomponents/Sidebar.vue';

const sideBarToggle = ref(false)
</script>
<style>
::-webkit-scrollbar {
    width: 3px;
    height: 3px;
}
 
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
 
::-webkit-scrollbar-thumb {
    background-color:  rgb(249 115 22);
}
</style>