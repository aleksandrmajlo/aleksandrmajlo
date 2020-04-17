<template>
  <a v-if="banner!==null" class="promoBanner" target="_blank" :href="banner.link">
    <span class="promoBanner__text">{{banner.description}}</span>
    <img :src="banner.photobig" alt />
  </a>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "Banner.vue",
  computed: {
    ...mapGetters({
      banner: "firms/banner_home"
    })
  }
};
</script>
