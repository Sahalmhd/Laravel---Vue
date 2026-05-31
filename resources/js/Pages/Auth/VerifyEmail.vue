<template>
  <div class="text-center space-y-4">
    <p>You need to be verified first to see this page!</p>

    <button
      @click="resend"
      class="bg-blue-500 text-white px-4 py-2 rounded"
      :disabled="form.processing"
    >
      Resend Verification Email
    </button>

    <p v-if="success" class="text-green-600">
      Verification link sent!
    </p>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const success = ref(false)

const form = useForm({})

const resend = () => {
  form.post(route('verification.send'), {
    preserveScroll: true,
    onSuccess: () => {
      success.value = true
    }
  })
}
</script>
