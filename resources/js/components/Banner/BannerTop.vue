<template>
  <div class="col-6 d-none d-lg-block">
    <a v-if="banner!==null" class="head-banner" target="_blank" :href="banner.link">
      <span class="head-banner__img-wrap">
        <img :src="banner.photosmall" alt />
      </span>
      <span class="head-banner__text">{{banner.description}}</span>
    </a>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "BannerTop",
  computed: {
    ...mapGetters({
      banner: "firms/banner_top"
    })
  }
};
</script>
