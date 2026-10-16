<template>
  <v-app>
    <Header />
    <NavigationDrawer />
     <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script setup lang="ts">
  import Header from '@/components/layout/Header.vue'
  import NavigationDrawer from '@/components/layout/NavigationDrawer.vue'
</script>