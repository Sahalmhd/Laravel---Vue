<template>
  <span>{{ FormattedPrice }}</span>
</template>

<script setup>
import { computed } from 'vue'

const props =defineProps({
  price:[Number,String],
})

const FormattedPrice = computed(()=>Number(props.price).toLocaleString('en-US', { style: 'currency', currency: 'USA' }))
</script>
