<template>
  <v-container class="fill-height d-flex flex-column justify-center" max-width="1100">
    <div>
      <v-img
        class="mb-4 font-weight-bold"
        height="150"
        src="@/assets/logo.png"
      />

      <div class="mb-8 text-center">
        <div class="text-body-medium font-weight-light mb-n1">Welcome to</div>
        <div class="text-display-medium font-weight-bold">{{varName}}</div>

        <v-btn color="primary" density="default" @click="atClick">Click Here</v-btn>
        <v-btn v-if="userType === 'Super Admin'" color="primary" density="default" @click="atClick">Super Admin</v-btn>
        <v-btn v-else color="primary" density="default" @click="atClick">User</v-btn>

        <h1>{{ publishedBooksMessage }}</h1>

        <v-btn color="primary" density="default" @click="atClickComputed">Click to change computed</v-btn>

        <v-btn color="primary" density="default" @click="atClickWatch">Click to trigger x watch</v-btn>
      </div>

      <div class="mb-8 text-center">
        <v-alert :color="item.color" v-for="item in items">
          {{ item.text }}
        </v-alert>
      </div>

      <div class="mb-8 text-center">
        <v-row>
          <v-col cols="12" md="4">
            <v-text-field placeholder="Col 1"></v-text-field>
          </v-col>

          <v-col cols="12" md="4">
            <v-text-field placeholder="Col 2"></v-text-field>
          </v-col>

          <v-col cols="12" md="4">
            <v-text-field placeholder="Col 3"></v-text-field>
          </v-col>
        </v-row>
      </div>

      <SampleComponent title="Maskin Unsa na Title">
      </SampleComponent>

      <SampleSlotComponent>
        <p>Sample rani mga badi</p>
      </SampleSlotComponent>
    </div>
  </v-container>
</template>

<script setup lang="ts">
  import { ref, onMounted, computed, watch } from 'vue'
  import SampleComponent from '@/components/SampleComponent.vue'
  import SampleSlotComponent from '@/components/SampleSlotComponent.vue'

  const varName = ref('String here')
  const userType = ref('User')
  const items = ref([
    { text: 'One', color: 'primary'},
    { text: 'Two', color: 'warning'}
  ])

  const author = ref({
    books: [],
  })

  const x = ref(0)

  const publishedBooksMessage = computed(() => {
    return author.value.books.length > 0 ? 'Yes' : 'No'
  })

  watch(x, (newX) => {
    console.log('x is ' + newX)
  })

  function atClick() {
    varName.value = 'Reset here'
    console.log(varName)

    let num = 0
    for(num; num < 10; num++){
      if(num === 2){
        console.log('TWO')
      }
    }
  }

  function atClickComputed() {
    author.value.books.push({
      id: 0,
      title: 'Moby Dick'
    })
  }

  function atClickWatch() {
    x.value++
  }

  onMounted(() => {
    console.log('Finished the DOM')
  })
</script>
