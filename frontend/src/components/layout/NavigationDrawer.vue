<template>
  <v-navigation-drawer
      v-model="layoutStore.navDrawer"
      :location="$vuetify.display.mobile ? 'bottom' : undefined"
      temporary
  >
    <v-list nav v-for="item in items">
      <v-list-item
          :prepend-icon="item.icons"
          :title="item.title"
          :to="item.route"
      ></v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script setup lang="ts">
  import { ref } from 'vue'
  import { useLayoutStore } from '@/stores/layout'

  const layoutStore = useLayoutStore()

  const items = ref([
    {
      title: 'Dashboard',
      route: '/dashboard',
      icons: 'mdi-monitor-dashboard',
    },
    {
      title: 'Form',
      route: '/form',
      icons: 'mdi-file-document',
    },
    {
      title: 'Reports',
      route: '/reports',
      icons: 'mdi-chart-bar',
    },
    {
      title: 'Profile',
      route: '/profile',
      icons: 'mdi-account',
    },
  ])
</script>