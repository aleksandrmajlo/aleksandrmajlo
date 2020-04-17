<template>
  <div
    v-if="showMapYesNoSidebar"
    class="sidebarLeft sidebarLeft--main section container-fluid features"
    id="sidebarLeft"
  >
    <div class="panel-block panel-block--lg">
      <banner></banner>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Banner from "~/components/Banner/Banner";
export default {
  computed: {
    ...mapGetters({
      showMapYesNoSidebar: "map/showMapYesNoSidebar"
    })
  },
  components: {
    Banner
  }
};
</script>
