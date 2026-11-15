<!-- eslint-disable vue/html-self-closing -->
<template>
  <v-container class="py-8" max-width="1100">
    <!-- Form Section -->
    <v-card class="pa-6 mb-8 w-100" elevation="2">
      <v-card-title class="text-h5 font-weight-bold mb-4 text-center">
        {{ isEditing ? 'Edit Item' : 'Item Entry Form' }}
      </v-card-title>

      <!-- 1. Select Category First -->
      <v-row>
        <v-col cols="12">
          <v-select
            v-model="categoryId"
            item-title="name"
            item-value="id"
            :items="categories"
            label="Select Category"
            :loading="loadingCategories"
          ></v-select>
        </v-col>
      </v-row>

      <!-- 2. Item Details -->
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="name" label="Item Name"></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="brand" label="Brand"></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field
            v-model="price"
            label="Price"
            prefix="₱"
            type="number"
          ></v-text-field>
        </v-col>
      </v-row>

      <v-row class="mt-2">
        <v-col class="d-flex justify-end ga-4" cols="12">
          <v-btn
            :color="isEditing ? 'success' : 'primary'"
            :loading="saving"
            @click="save"
          >
            {{ isEditing ? 'Update' : 'Add' }}
          </v-btn>

          <v-btn color="warning" @click="cancel">Cancel</v-btn>
        </v-col>
      </v-row>
    </v-card>

    <!-- Items Table Section -->
    <v-card class="w-100" elevation="2">
      <v-card-title class="d-flex align-center justify-space-between px-6 pt-4 pb-2">
        <span class="text-h6 font-weight-bold">Items List</span>

        <v-btn
          icon="mdi-refresh"
          :loading="loadingItems"
          size="small"
          title="Refresh items"
          variant="text"
          @click="getItems"
        ></v-btn>
      </v-card-title>

      <v-progress-linear
        v-if="loadingItems"
        color="primary"
        indeterminate
      ></v-progress-linear>

      <v-divider v-else></v-divider>

      <v-table hover>
        <thead>
          <tr>
            <th class="text-left font-weight-bold">Item Name</th>
            <th class="text-left font-weight-bold">Brand</th>
            <th class="text-left font-weight-bold">Category</th>
            <th class="text-left font-weight-bold">Price</th>
            <th class="text-center font-weight-bold">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-if="loadingItems">
            <td class="text-center py-6 text-grey" colspan="5">
              <v-progress-circular
                class="mr-2"
                color="primary"
                indeterminate
                size="24"
              ></v-progress-circular>

              <span>Loading items...</span>
            </td>
          </tr>

          <tr v-else-if="items.length === 0">
            <td class="text-center text-grey py-6" colspan="5">
              No items available in the database.
            </td>
          </tr>

          <tr v-for="item in paginatedItems" v-else :key="item.id">
            <td>{{ item.name }}</td>
            <td>{{ item.brand }}</td>

            <td>
              <v-chip color="primary" size="small" variant="tonal">
                {{ item.category?.name || 'No Category' }}
              </v-chip>
            </td>

            <td class="font-weight-medium">
              ₱{{ Number(item.price).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}
            </td>

            <td class="text-center">
              <v-btn
                class="mr-1"
                color="info"
                icon="mdi-pencil"
                size="x-small"
                title="Edit item"
                variant="text"
                @click="editItem(item)"
              ></v-btn>

              <v-btn
                color="error"
                icon="mdi-delete"
                size="x-small"
                title="Delete item"
                variant="text"
                @click="deleteItem(item)"
              ></v-btn>
            </td>
          </tr>
        </tbody>
      </v-table>

      <v-divider v-if="items.length > 0"></v-divider>

      <div
        v-if="items.length > 0"
        class="d-flex flex-wrap align-center justify-space-between px-6 py-3 ga-4"
      >
        <div class="d-flex align-center ga-2">
          <span class="text-caption text-grey">Items per page:</span>

          <v-select
            v-model="itemsPerPage"
            density="compact"
            hide-details
            :items="[5, 10, 20]"
            style="width: 85px;"
            variant="outlined"
          ></v-select>
        </div>

        <span class="text-caption text-grey">
          Showing {{ (page - 1) * itemsPerPage + 1 }} - {{ Math.min(page * itemsPerPage, items.length) }} of {{ items.length }} items
        </span>

        <v-pagination
          v-model="page"
          density="compact"
          :length="pageCount"
          size="small"
          :total-visible="5"
        ></v-pagination>
      </div>
    </v-card>
  </v-container>
</template>

<script lang="ts" setup>
  import axios from 'axios'
  import { computed, onMounted, ref, watch } from 'vue'

  interface Category {
    id: string
    name: string
  }

  interface Item {
    id: string
    name: string
    brand: string
    price: number | string
    category_id: string
    category?: Category
  }

  const categoryId = ref<string | null>(null)
  const name = ref('')
  const brand = ref('')
  const price = ref('')
  const editingItemId = ref<string | null>(null)

  const isEditing = computed(() => editingItemId.value !== null)

  const loadingCategories = ref(false)
  const loadingItems = ref(false)
  const saving = ref(false)

  const categories = ref<Category[]>([])
  const items = ref<Item[]>([])

  const page = ref(1)
  const itemsPerPage = ref(5)

  const pageCount = computed(() => {
    return Math.ceil(items.value.length / itemsPerPage.value) || 1
  })

  const paginatedItems = computed(() => {
    const start = (page.value - 1) * itemsPerPage.value
    return items.value.slice(start, start + itemsPerPage.value)
  })

  watch([itemsPerPage, items], () => {
    if (page.value > pageCount.value) {
      page.value = pageCount.value
    }
  })

  async function getCategories () {
    loadingCategories.value = true
    try {
      const response = await axios.get('http://localhost:8000/api/categories')
      categories.value = response.data
      console.log('Categories fetched successfully:', categories.value)
    } catch (error) {
      console.error('Error fetching categories:', error)
    } finally {
      loadingCategories.value = false
    }
  }

  async function getItems () {
    loadingItems.value = true
    try {
      const response = await axios.get('http://localhost:8000/api/items')
      items.value = response.data
      console.log('Items fetched successfully:', items.value)
    } catch (error) {
      console.error('Error fetching items:', error)
    } finally {
      loadingItems.value = false
    }
  }

  function editItem (item: Item) {
    editingItemId.value = item.id
    categoryId.value = item.category_id
    name.value = item.name
    brand.value = item.brand
    price.value = String(item.price)
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }

  async function deleteItem (item: Item) {
    if (!confirm(`Are you sure you want to delete "${item.name}"?`)) {
      return
    }

    try {
      await axios.delete(`http://localhost:8000/api/items/${item.id}`)
      alert('Item deleted successfully!')
      if (editingItemId.value === item.id) {
        reset()
      }
      await getItems()
    } catch (error) {
      console.error('Error deleting item:', error)
      alert('Failed to delete item. Check console for details.')
    }
  }

  async function save () {
    if (!categoryId.value) {
      alert('Palihug pagpili una og Category!')
      return
    }

    if (!name.value.trim() || !brand.value.trim() || price.value === '') {
      alert('Palihug kompletoha ang tanang fields!')
      return
    }

    saving.value = true
    try {
      const payload = {
        category_id: categoryId.value,
        name: name.value,
        brand: brand.value,
        price: Number(price.value),
      }
      console.log('Saving item payload:', payload)

      if (editingItemId.value) {
        const response = await axios.put(`http://localhost:8000/api/items/${editingItemId.value}`, payload)
        console.log('Item updated successfully:', response.data)
        alert('Item updated successfully!')
      } else {
        const response = await axios.post('http://localhost:8000/api/items', payload)
        console.log('Item created successfully:', response.data)
        alert('Item created successfully!')
      }

      reset()
      await getItems()
    } catch (error) {
      console.error('Error saving item:', error)
      alert('Failed to save item. Check console for details.')
    } finally {
      saving.value = false
    }
  }

  function reset () {
    editingItemId.value = null
    categoryId.value = null
    name.value = ''
    brand.value = ''
    price.value = ''
  }

  function cancel () {
    reset()
  }

  onMounted(() => {
    getCategories()
    getItems()
  })
</script>
