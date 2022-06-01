<template>
  <div class="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg">
          <div class="d-flex media text-start">
            <img src="../assets/profile-logo.png" class="user-pic mr-3" alt="Profile Logo" />
            <div class="media-body">
              <h5 class="mt-0">{{ firstName }} {{ lastName }}</h5>
              <p>
                Will you do the same for me? It's time to face the music I'm no
                longer your muse. Heard it's beautiful, be the judge and my
                girls gonna take a vote. I can feel a phoenix inside of me.
                Heaven is jealous of our love, angels are crying from up above.
                Yeah, you take me to utopia.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.css";

export default {
  name: "ProfileView",
  data: function() {
    return {
      firstName: 'Raka',
      lastName: 'Widjaja'
    }
  }
};
</script>

<style scoped>
.user-pic {
  height: 120px;
  width: 120px;
  border-radius: 200%;
  margin-right: 20px;
}
</style>