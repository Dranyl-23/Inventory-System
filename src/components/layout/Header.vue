<template>
  <v-app-bar
      color="primary"
      density="comfortable"
  >
    <template v-slot:prepend>
      <v-app-bar-nav-icon @click="layoutStore.navDrawer = !layoutStore.navDrawer"></v-app-bar-nav-icon>
    </template>

    <v-app-bar-title>Inventory System</v-app-bar-title>

    <template v-slot:append>
      <v-btn icon="mdi-dots-vertical"></v-btn>
    </template>
  </v-app-bar>
</template>

<script setup lang="ts">
import { useLayoutStore } from '@/stores/layout'

const layoutStore = useLayoutStore() 
</script>