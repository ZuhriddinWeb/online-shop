<template>
    <router-view />
</template>

<script setup>
import store from '../store';

if(store.state.user){
    axios.get(`cart-user/${store.state.user.id}`).then(({ data }) => {
        store.state.cart = data.map((cart) => cart.product_id)
    })
}
</script>
