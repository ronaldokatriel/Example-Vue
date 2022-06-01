<template>
  <div class="todo">
    <div class="container">
      <div class="row header mb-5">
        <div class="col-lg-12 p-3">
          <h1>What I do today?</h1>
        </div>
      </div>
      <div class="row content">
        <div class="col-lg-12 d-flex justify-content-center text-start">
          <div class="pekerjaan-rumah">
            <div
              v-for="tugasSaya in tugas"
              v-bind:key="tugasSaya.id"
              class="tugas"
            >
             <ItemTugas v-bind:tugasSaya="tugasSaya"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ItemTugas from '@/components/ItemTugas.vue'

export default {
  name: "TodoView",
  data: function () {
    return {
      tugas: [
        {
          id: 1,
          namaTugas: "Membersihkan Toilet",
          isDone: false,
        },
        {
          id: 2,
          namaTugas: "Ngoding Website",
          isDone: false,
        },
        {
          id: 3,
          namaTugas: "Beli SSD",
          isDone: false,
        },
        {
          id: 4,
          namaTugas: "Istirahat",
          isDone: false,
        },
      ],
    };
  },
  components: {
      ItemTugas
  },
};
</script>

<style scoped>
.header {
  background-color: #42b983;
  color: #fff;
}

.header h1 {
  margin: 0;
}

.item-completed {
  text-decoration: line-through;
}
</style>