<template>
    <span>{{ FormatedPrice }}</span>
</template>

<script setup>
import { computed } from 'vue'

const props =defineProps({
  price:[Number,String],
})

const FormatedPrice = computed(()=>Number(props.price).toLocaleString('de-US', { style: 'currency', currency: 'USA' }))
</script>