<template>
  <Box>
    <Link :href="route('listings.show', listing.id)">
      <div class="flex items-center gap-1">
        <Price :price="listing.price" class="text-2xl" />
        <div class="text-xs text-gray-500">
          <Price :price="monthlyPayment" /> pm
        </div>
      </div>
      <ListingSpace :listing="listing" class="text-lg" />
      <ListingAddress :listing="listing" class="text-gray-500" />
    </Link>
  </Box>
</template>
<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/UI/Price.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { Link } from '@inertiajs/vue3'
const props = defineProps({listing: Object})

const {monthlyPayment} =useMonthlyPayment(props.listing.price,2.5,25)

</script>
