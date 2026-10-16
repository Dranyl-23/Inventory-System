<template>
  <v-container class="fill-height d-flex flex-column justify-center" max-width="1100">
    <div class="mb-8 text-center">
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="firstName" label="First Name"></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="middleName" label="Middle Name"></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-text-field v-model="lastName" label="Last Name"></v-text-field>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="4">
          <v-text-field v-model="birthDate" type="date" label="Birthdate"></v-text-field>
        </v-col>

        <v-col cols="12" md="4">
          <v-select :items="['Single', 'Married', 'Window', 'Widower']" v-model="civilStatus" label="Civil Status"></v-select>
        </v-col>

        <v-col cols="12" md="4">
          <v-select :items="['Male', 'Female']" v-model="gender" label="Gender"></v-select>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12">
          <v-textarea label="Address" v-model="address"></v-textarea>
        </v-col>
      </v-row>

      <v-row>
        <v-btn color="primary" @click="save">Save</v-btn>
        <v-btn color="warning" @click="reset">Reset</v-btn>
      </v-row>
    </div>
  </v-container>
</template>

<script lang="ts" setup>
  import { ref } from 'vue'

  const firstName = ref('')
  const middleName = ref('')
  const lastName = ref('')
  const birthDate = ref('')
  const civilStatus = ref('')
  const gender = ref('')
  const address = ref('')

  function save() {
    console.log(firstName.value)
    console.log(middleName.value)
    console.log(lastName.value)
    console.log(birthDate.value)
    console.log(civilStatus.value)
    console.log(gender.value)
    console.log(address.value)
  }

  function reset() {
    firstName.value = ''
    middleName.value = ''
    lastName.value = ''
    birthDate.value = ''
    civilStatus.value = ''
    gender.value = ''
    address.value = ''
  }
</script>
