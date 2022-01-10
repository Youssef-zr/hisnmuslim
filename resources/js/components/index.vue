<template>
  <section class="mt-4 mt-md-0">
    <h3 class="__title text-center mb-4 text-success">
      {{ dikrSelectedValues.title }}
    </h3>
    <div class="loeader mt-5 d-flex justify-content-center" v-if="isLoading">
      <div class="hollow-dots-spinner">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>
    <div class="hisn" v-else>
      <div class="audio-player">
        <audio controls class="d-block mb-3 w-100" id="audio">
          <source :src="audioSelectedSrc" type="audio/mp3" />
          Your browser does not support the audio tag.
        </audio>
      </div>
      <ul class="list-unstyled list-group">
        <li
          v-for="item in dikrValues"
          :key="item.ID"
          :class="`list-group-item mb-3 border ${
            item.ID == active ? 'activeHisn' : ''
          }`"
        >
          <span class="text text-right d-block line-h-15">
            {{ item.ARABIC_TEXT }}
          </span>
          <span
            class="d-block mt-1 clickable"
            @click="changeAudioSrc(item.AUDIO, item.ID)"
            title="play"
          >
            <i class="fa fa-2x fa-play-circle text-success"></i>
          </span>
        </li>
      </ul>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      isLoading: true,
      dikrSelectedValues: { id: 27, title: "أذكار الصباح والمساء" },
      dikrValues: {},
      audioSelectedSrc: "https://www.hisnmuslim.com/audio/ar/75.mp3",
      active: 75,
    };
  },
  created() {
    this.getHaditData(this.dikrSelectedValues);
  },
  mounted() {
    this.$root.$on("hisnChanged", (obj) => {
      setTimeout(() => {
        this.dikrSelectedValues = { id: obj.id, title: obj.title };
      }, 600);
    });
  },
  methods: {
    getHaditData(obj) {
      this.isLoading = true;
      fetch(`https://www.hisnmuslim.com/api/ar/${obj.id}.json`)
        .then((res) => {
          if (res.status == 404) {
            this.err = "dikr data not found";
          }
          return res.json();
        })
        .then(this.setResult);
    },
    setResult(result) {
      this.dikrValues = result[this.dikrSelectedValues.title];
      setTimeout(() => {
        this.isLoading = false;
      }, 700);
    },
    changeAudioSrc(audioSrc, itemId) {
      this.audioSelectedSrc = audioSrc;
      this.active = itemId;
      const audioPlayer = document.getElementById("audio");
      audioPlayer.load();
      audioPlayer.play();
    },
    hello() {
      alert("gds");
    },
  },
  watch: {
    dikrSelectedValues: function (val) {
      this.getHaditData(val);
    },
  },
};
</script>
