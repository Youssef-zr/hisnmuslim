<template>
  <div class="asidebar-container">
    <div class="sidebar-toggler">
      <span class="btn-toggler" @click="sidebarStatus = !sidebarStatus">
        <i
          :class="`fa fa-2x ${
            sidebarStatus == true ? 'fa-times text-success' : 'fa-bars'
          }`"
          :title="`${sidebarStatus == true ? 'اغلاق القائمة' : 'فتح القائمة'}`"
        ></i>
      </span>
    </div>
    <transition name="slide-fade">
      <aside v-if="sidebarStatus">
        <ul class="list-unstyled list-group sidebar">
          <li
            v-for="item in hisnObj"
            :key="item.ID"
            :class="`list-group-item mb-3 text-right ${
              item.ID == activeId ? 'sidebar-active' : ''
            }`"
          >
            <span
              class="text-white clickable"
              @click="changeHisn(item.ID, item.TITLE)"
              >{{ item.TITLE }}</span
            >
            <i class="fa fa-tags text-white ml-1"></i>
          </li>
        </ul>
      </aside>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sidebarStatus: false,
      hisnObj: [],
      hisnSelected: {
        id: null,
        title: "",
      },
      activeId: 27,
    };
  },
  created() {
    this.fetchHisn();
  },
  methods: {
    fetchHisn() {
      fetch("http://www.hisnmuslim.com/api/ar/husn_ar.json")
        .then((res) => {
          if (res.status == 404) {
            this.err = "hisn not found";
          }
          return res.json();
        })
        .then(this.setResults);
    },
    setResults(result) {
      this.hisnObj = result["العربية"];
    },
    changeHisn(id, title) {
      // close sidebar
      this.sidebarStatus = false;

      this.hisnSelected = { id: id, title: title };
      this.activeId = id;
      setTimeout(() => {
        this.$root.$emit("hisnChanged", this.hisnSelected);
      }, 500);
    },
  },
};
</script>


<style lang="css">
.clickable {
  cursor: pointer;
}

.line-h-15 {
  line-height: 27px !important;
}
</style>