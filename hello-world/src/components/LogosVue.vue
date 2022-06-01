<template>
    <div class="logos-wrapper">
        <h2 class="title-header">Find the Best Logo in Town</h2>
        <div class="item-logos">
          <img class="logos" src="../assets/twitter-logo.svg" alt="Twitter Logo">
        </div>
        <div class="item-logos">
          <img class="logos" src="../assets/starbucks-logo.svg" alt="Starbucks Logo">
        </div>
        <div class="item-logos">
          <img class="logos" src="../assets/youtube-logo.svg" alt="Youtube Logo">
        </div>
    </div>
</template>

<script>
export default {
  name: 'LogosVue'
}
</script>

<style scoped>
  .logos-wrapper {
    margin: auto;
    width: 70%;
    overflow: hidden;
  }

  .title-header {
    text-align: center;
    font-size: 2em;
    margin-bottom: 80px;
  }

  .item-logos {
    float: left;
    width: 150px;
    height: 150px;
    margin-right: 70px;
    margin-bottom: 70px;
  }

  .item-logos .logos {
    width: 100%;
    height: 100%;
  }
</style>