<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="listing in listings" :key="listing.id">
      <Link :href="route('listings.show', listing.id)">
        <ListingAddress :listing="listing" />
      </Link>
      <div>
        <Link :href="route('listings.edit',{listing:listing.id})">Edit</Link>
      </div>
      <div>
        <Link :href="route('listings.destroy',{listing:listing.id})" method="DELETE">Delete</Link>
      </div>
    </Box>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
defineProps({
  listings: Array,
})
</script>
