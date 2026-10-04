// Utilities
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useLayoutStore = defineStore('layout', () => {
    const navDrawer = ref(true)

    return {
        navDrawer
    }
})
